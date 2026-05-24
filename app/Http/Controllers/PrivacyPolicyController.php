<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PrivacyPolicyController
{
    /**
     * Show the privacy policy for the application.
     *
     * @return View
     */
    public function show(): \Illuminate\Contracts\View\View|Factory
    {
        $policyFile = localizedMarkdownPath('policy.md');

        if ($policyFile === null || $policyFile === '' || $policyFile === '0' || ! file_exists($policyFile)) {
            abort(404, 'Privacy policy file not found.');
        }

        $policyContent = file_get_contents($policyFile);

        if ($policyContent === false) {
            abort(500, 'Unable to read cookie policy file.');
        }

        $policy = Str::markdown($policyContent);

        if (auth()->check()) {
            return view('markdown.auth.policy', [
                'policy' => $policy,
            ]);
        }

        return view('markdown.guest.policy', [
            'policy' => $policy,
        ]);
    }
}
