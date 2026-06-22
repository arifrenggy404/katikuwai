<?php

namespace App\Providers;

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
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $setting = null;
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $setting = \App\Models\Setting::first();
            }
            $view->with('setting', $setting);
        });
    }
}
