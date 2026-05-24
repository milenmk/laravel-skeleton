<?php

/*
 * Copyright (c) 2025. Milen Karaganski (info@minkov.dev). All rights reserved.
 * This website (laragdpr.com) and its content are protected.
 */

declare(strict_types=1);

namespace App\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * This trait is used to find if the user exists for a given model relation.
 */
trait ResolveUser
{
    /**
     * Attempt to resolve the related user for a given model.
     */
    private function resolveUser(Model $model): User|Collection|null
    {
        if ($model->relationLoaded('user') && $model->user) {
            return $model->user;
        }

        /** @var string|null $userId */
        $userId = $model->getAttribute('user_id');

        return $userId ? User::find($userId) : null;
    }
}
