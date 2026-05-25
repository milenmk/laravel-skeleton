<?php

declare(strict_types=1);

namespace App\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Exceptions\DriverException;
use Intervention\Image\Exceptions\InvalidArgumentException;
use Intervention\Image\ImageManager;
use Intervention\Image\Typography\FontFactory;

trait HasProfileAvatar
{
    /**
     * Delete the user's profile photo.
     */
    public function deleteProfileAvatar(): void
    {
        if ($this->profile_photo_path === null) {
            return;
        }
        // @codeCoverageIgnoreEnd

        Storage::disk($this->profilePhotoDisk())->delete($this->profile_photo_path);

        $this->forceFill([
            'profile_photo_path' => null,
        ])->save();
    }

    /**
     * Get the disk that profile photos should be stored on.
     */
    protected function profilePhotoDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return Attribute<string, never>
     */
    public function profilePhotoUrl(): Attribute
    {
        return Attribute::get(fn (): string => $this->profile_photo_path
            ? Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path)
            : $this->generateInitialsImageUrl());
    }

    /**
     * @throws InvalidArgumentException
     * @throws DriverException
     */
    protected function generateInitialsImageUrl(): string
    {
        $initials = $this->initials();

        // Create a new ImageManager instance with a driver
        $manager = new ImageManager(new Driver);

        // Create a new image with a background color
        $image = $manager->createImage(100, 100)->fill('#EBF4FF');

        // Add text to the image
        $image->text($initials, 50, 50, function (FontFactory $font): void {
            // Use Geist font family
            $font->filename(resource_path('css/fonts/Geist/Geist-Light.ttf'));
            $font->size(48);
            $font->color('rgb(6, 182, 212)');
            $font->align('center', 'center');
        });

        // Use the encoder properly
        $encoded = $image->encode(new PngEncoder);

        return 'data:image/png;base64,' . base64_encode($encoded->toString());
    }

    public function updateProfileAvatar(UploadedFile $photo, string $storage_path = 'profile-photos'): void
    {
        tap($this->profile_photo_path, function ($previous) use ($photo, $storage_path): void {
            $this->forceFill([
                'profile_photo_path' => $photo->storePublicly($storage_path, [
                    'disk' => $this->profilePhotoDisk(),
                ]),
            ])->save();

            if ($previous) {
                // @codeCoverageIgnoreStart
                Storage::disk($this->profilePhotoDisk())->delete($previous);
                // @codeCoverageIgnoreEnd
            }
        });
    }
}
