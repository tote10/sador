<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        // Expose site settings to every Blade view as $settings (key => value),
        // so editing them in the admin panel actually changes the public site.
        // Guarded so artisan commands still work before the settings table exists.
        try {
            if (Schema::hasTable('settings')) {
                View::share('settings', Setting::pluck('value', 'key'));
            } else {
                View::share('settings', collect());
            }
        } catch (\Throwable $e) {
            View::share('settings', collect());
        }
    }
}
