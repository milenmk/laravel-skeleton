<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Notifications\LoggingFailedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Notification;
use Log;
use Throwable;

class LogMessageJob implements ShouldQueue
{
    use Queueable;

    /**
     * @param array<string, mixed> $context
     */
    public function __construct(public string $level, public string $message, public array $context = []) {}

    public function handle(): void
    {

        try {
            Log::{$this->level}($this->message, $this->context);
            /** @phpstan-ignore catch.neverThrown */
        } catch (Throwable $e) {
            Notification::route('mail', config('logging.admin_email'))
                ->notify(new LoggingFailedNotification($this->message, $this->context, $e));
        }
    }
}
