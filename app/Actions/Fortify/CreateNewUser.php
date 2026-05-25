<?php

declare(strict_types=1);

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Milenmk\LaravelBlacklist\Services\BlacklistService;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;
    use ProfileValidationRules;

    public function __construct(protected BlacklistService $blacklistService) {}

    /**
     * Validate and create a newly registered user.
     *
     * @param array<string, string> $input
     *
     * @throws ValidationException
     */
    public function create(array $input): User
    {
        Validator::make(
            $input, [
                ...$this->profileRules(),
                'password' => $this->passwordRules(),
                'terms' => ['accepted', 'required'],
            ],
            [
                'terms' => 'You have to agree to the terms of service and privacy policy!',
            ])->validate();

        $attributes = [
            'last_name' => 'Last Name',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ];

        $blacklistErrors = $this->blacklistService->checkFields($input, null, $attributes);

        if ($blacklistErrors !== []) {
            throw ValidationException::withMessages($blacklistErrors);
        }

        return User::create([
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
