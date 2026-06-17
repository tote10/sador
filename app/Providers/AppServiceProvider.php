<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
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
        // Cap "remember me" at 30 days (Laravel's default is ~400 days).
        // Without "remember me", SESSION_EXPIRE_ON_CLOSE logs the user out when the browser closes.
        Auth::guard('web')->setRememberDuration(60 * 24 * 30);

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
