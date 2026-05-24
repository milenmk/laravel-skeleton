<?php

/*
 * Copyright (c) 2025. Milen Karaganski (info@minkov.dev). All rights reserved.
 * This website (laragdpr.com) and its content are protected.
 */

declare(strict_types=1);

namespace App\Traits;

/**
 * Trait InteractsWithEnum.
 *
 * This trait is intended to be used with PHP 8.1+ backed enums.
 * It provides additional methods for working with enum cases.
 */
trait InteractsWithEnum
{
    /**
     * Get all ENUM as array value => name.
     *
     * @return array<string|int, string> Array with values as keys and names as values
     */
    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    /**
     * Get all ENUM values.
     *
     * @return array<string|int> Array of enum case values
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get all ENUM names.
     *
     * @return array<string> Array of enum case names
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Find ENUM by name or value.
     *
     * @param mixed $needle The name or value to search for
     * @return static|null The enum case if found, null otherwise
     */
    public static function find(mixed $needle): ?static
    {
        // Validate input to prevent code injection
        if (! is_string($needle) && ! is_int($needle)) {
            return null;
        }

        // Convert to string for safe comparison
        $needle = (string) $needle;

        // Validate that needle contains only safe characters for enum names
        if (in_array(preg_match('/^[a-zA-Z_]\w*$/', $needle), [0, false], true)) {
            // If it's not a valid enum name format, try as value
            return self::tryFrom($needle);
        }

        // Safe lookup by iterating through cases instead of using constant()
        foreach (self::cases() as $case) {
            if ($case->name === $needle) {
                return $case;
            }
        }

        // Try to find by value
        return self::tryFrom($needle);
    }
}
