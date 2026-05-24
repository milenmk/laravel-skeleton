<?php

declare(strict_types=1);

namespace App\Services;

use App\Jobs\LogMessageJob;

class SafeLoggerService
{
    /**
     * @param array<string, mixed> $context
     */
    public static function error(string $message, array $context = []): void
    {
        self::log('error', $message, $context);
    }

    /**
     * @param array<string, mixed> $context
     */
    public static function log(string $level, string $message, array $context = []): void
    {
        // Push logging to the queue asynchronously
        dispatch(new LogMessageJob($level, $message, $context));
    }

    /**
     * @param array<string, mixed> $context
     */
    public static function info(string $message, array $context = []): void
    {
        self::log('info', $message, $context);
    }
}
