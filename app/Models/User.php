<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Concerns\HasQueryFilters;
use App\Contracts\HasSearchableFields;
use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
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
#[Fillable(['name', 'email', 'password', 'two_factor_confirmed_at'])]
#[Hidden(['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'])]
class User extends Authenticatable implements HasSearchableFields, MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

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
    protected static array $searchable = ['name', 'email'];

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
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
}
