<?php

declare(strict_types=1);

namespace App\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasProfileCover
{
    /**
     * Delete the user's profile photo.
     */
    public function deleteProfileCover(): void
    {
        // @codeCoverageIgnoreStart
        if ($this->profile_cover_path === null) {
            return;
        }
        // @codeCoverageIgnoreEnd

        Storage::disk($this->profileCoverDisk())->delete($this->profile_cover_path);

        $this->forceFill([
            'profile_cover_path' => null,
        ])->save();
    }

    /**
     * Get the disk that profile photos should be stored on.
     */
    protected function profileCoverDisk(): string
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }

    /**
     * Get the URL to the user's profile cover.
     *
     * @return Attribute<string, never>
     */
    public function profileCoverUrl(): Attribute
    {
        return Attribute::get(fn (): string => $this->profile_cover_path
            ? Storage::disk($this->profileCoverDisk())->url($this->profile_cover_path)
            : '');
    }

    /**
     * Update the user's profile photo.
     */
    public function updateProfileCover(UploadedFile $photo, string $storage_path = 'profile-covers'): void
    {
        tap($this->profile_cover_path, function ($previous) use ($photo, $storage_path): void {
            $this->forceFill([
                'profile_cover_path' => $photo->storePublicly($storage_path, [
                    'disk' => $this->profileCoverDisk(),
                ]),
            ])->save();

            if ($previous) {
                // @codeCoverageIgnoreStart
                Storage::disk($this->profileCoverDisk())->delete($previous);
                // @codeCoverageIgnoreEnd
            }
        });
    }
}
