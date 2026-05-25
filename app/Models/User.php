<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasProfileAvatar;
use App\Concerns\HasProfileCover;
use App\Concerns\HasQueryFilters;
use App\Contracts\HasSearchableFields;
use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

/**
 * @mixin Eloquent
 *
 * @template-use HasQueryFilters<self>
 */
#[Fillable(['name', 'last_name', 'email', 'profile_cover_path', 'profile_photo_path', 'password', 'two_factor_confirmed_at'])]
#[Hidden(['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'])]
class User extends Authenticatable implements HasSearchableFields, MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    use HasProfileAvatar;
    use HasProfileCover;

    /** @use HasQueryFilters<self> */
    use HasQueryFilters;

    use HasUuids;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * List of searchable columns used by HasQueryFilters when no fields are passed.
     *
     * @var list<string>
     */
    protected static array $searchable = ['name', 'last_name', 'email'];

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        $nameInitials = Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');

        $lastNameInitials = Str::of($this->last_name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');

        return $nameInitials . $lastNameInitials;
    }

    /**
     * @return list<string>
     */
    public function searchableFields(): array
    {
        return self::$searchable;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    /**
     * Get user full name as attribute.
     *
     * @return Attribute<string, never>
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(get: fn (mixed $value, array $attributes): string => $this->name . ' ' . $this->last_name);
    }
}
