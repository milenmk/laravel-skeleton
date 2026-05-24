<?php

declare(strict_types=1);

namespace App\Contracts;

interface HasSearchableFields
{
    /**
     * @return list<string>
     */
    public function searchableFields(): array;
}
