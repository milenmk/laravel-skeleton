<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CookiePolicyController
{
    /**
     * Show the cookie policy for the application.
     *
     * @return View
     */
    public function show(): \Illuminate\Contracts\View\View|Factory
    {
        $cookieFile = localizedMarkdownPath('cookies.md');

        if ($cookieFile === null || $cookieFile === '' || $cookieFile === '0' || ! file_exists($cookieFile)) {
            abort(404, 'Cookie policy file not found.');
        }

        $cookieContent = file_get_contents($cookieFile);

        if ($cookieContent === false) {
            abort(500, 'Unable to read cookie policy file.');
        }

        $cookies = Str::markdown($cookieContent);

        if (auth()->check()) {
            return view('markdown.auth.cookies', [
                'cookies' => $cookies,
            ]);
        }

        return view('markdown.guest.cookies', [
            'cookies' => $cookies,
        ]);
    }
}
