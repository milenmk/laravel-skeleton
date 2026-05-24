<?php

/*
 * Copyright (c) 2025. Milen Karaganski (info@minkov.dev). All rights reserved.
 * This website (laragdpr.com) and its content are protected.
 */

declare(strict_types=1);

namespace App\Contracts;

interface HasDescription
{
    /**
     * Get the description for the enum case.
     */
    public function description(): string;
}
