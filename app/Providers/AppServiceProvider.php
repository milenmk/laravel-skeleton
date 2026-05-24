<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        // Force HTTPS
        URL::forceHttps();

        // Prevent lazy loading
        Model::shouldBeStrict();

        // Turn morph map enforcement on (new in 8.59.0).
        Relation::requireMorphMap();

        // Map morphs in the standard way.
        Relation::enforceMorphMap([
            'user' => User::class,
        ]);

        // Enable aggressive prefetching of assets.
        Vite::useAggressivePrefetching();
    }
}
