<?php

declare(strict_types=1);

use App\Http\Controllers\CookiePolicyController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\TermsOfServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home')->label(__('Home'));

Route::get('terms-of-service', [TermsOfServiceController::class, 'show'])->name('terms.show');
Route::get('privacy-policy', [PrivacyPolicyController::class, 'show'])->name('policy.show');
Route::get('cookies', [CookiePolicyController::class, 'show'])->name('cookie.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->label(__('Dashboard'));
});
