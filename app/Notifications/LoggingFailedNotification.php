<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Throwable;

class LoggingFailedNotification extends Notification
{
    use Queueable;

    /**
     * @param array<string, mixed> $context
     */
    public function __construct(public string $message, public array $context, public Throwable $exception) {}

    public function toMail(): MailMessage
    {
        return (new MailMessage)
            ->subject('Logging Failure Detected')
            ->line("Message: {$this->message}")
            ->line("Exception: {$this->exception->getMessage()}")
            ->line('Context: ' . json_encode($this->context));
    }

    /**
     * @return array<int, string>
     */
    public function via(): array
    {
        return ['mail'];
    }
}
