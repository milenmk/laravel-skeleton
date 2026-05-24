<?php

declare(strict_types=1);

use Livewire\Component;
use Livewire\Features\SupportEvents\Event;

if (! function_exists('dispatch_success_notification')) {
    function dispatch_success_notification(?Component $livewireComponent, string|array $message = ''): Event
    {
        return $livewireComponent->dispatch(
            'success-save',
            type: 'success',
            title: $message !== '' && $message !== '0' && $message !== [] ? $message : __('Your data is saved successfully'),
        );
    }
}

if (! function_exists('dispatch_failure_notification')) {
    function dispatch_failure_notification(?Component $livewireComponent, string|array $message): Event
    {
        return $livewireComponent->dispatch('error-saving', type: 'warning', title: $message);
    }
}

if (! function_exists('localizedMarkdownPath')) {
    function localizedMarkdownPath(string $name): ?string
    {
        $localName = preg_replace('#(\.md)$#i', '.'.app()->getLocale().'$1', $name);

        return Arr::first([resource_path('markdown/'.$localName), resource_path('markdown/'.$name)],
            fn ($path): bool => file_exists($path));
    }
}
