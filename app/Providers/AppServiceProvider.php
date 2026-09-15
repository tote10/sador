<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Cap "remember me" at 30 days (Laravel's default is ~400 days).
        // Without "remember me", SESSION_EXPIRE_ON_CLOSE logs the user out when the browser closes.
        Auth::guard('web')->setRememberDuration(60 * 24 * 30);

        // Expose site settings to every Blade view as $settings (key => value),
        // so editing them in the admin panel actually changes the public site.
        // Cached forever (flushed in SettingController@update) so the public site
        // doesn't hit the DB for settings on every request. The schema check only
        // runs on a cache miss, and we never cache the "table missing" state so the
        // value self-heals once migrations have run.
        try {
            $settings = Cache::rememberForever('site_settings', function () {
                return Schema::hasTable('settings')
                    ? Setting::pluck('value', 'key')
                    : null;
            });

            if ($settings === null) {
                Cache::forget('site_settings');
                $settings = collect();
            }

            View::share('settings', $settings);
        } catch (\Throwable $e) {
            View::share('settings', collect());
        }
    }
}
