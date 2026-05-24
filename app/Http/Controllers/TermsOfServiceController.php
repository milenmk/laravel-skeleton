<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TermsOfServiceController
{
    /**
     * Show the terms of service for the application.
     *
     * @return View
     */
    public function show(): \Illuminate\Contracts\View\View|Factory
    {
        $termsFile = localizedMarkdownPath('terms.md');

        if ($termsFile === null || $termsFile === '' || $termsFile === '0' || ! file_exists($termsFile)) {
            abort(404, 'TOS file not found.');
        }

        $termsContent = file_get_contents($termsFile);

        if ($termsContent === false) {
            abort(500, 'Unable to read cookie policy file.');
        }

        $terms = Str::markdown($termsContent);

        if (auth()->check()) {
            return view('markdown.auth.terms', [
                'terms' => $terms,
            ]);
        }

        return view('markdown.guest.terms', [
            'terms' => $terms,
        ]);
    }
}
