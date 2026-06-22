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
            $demographics = collect();
            $budgets = collect();
            $events = collect();

            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $setting = \App\Models\Setting::first();
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('demographics')) {
                $demographics = \App\Models\Demographic::all();
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('budgets')) {
                $budgets = \App\Models\Budget::all();
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('events')) {
                $events = \App\Models\Event::orderBy('date', 'asc')->get();
            }

            $view->with([
                'setting' => $setting,
                'demographics' => $demographics,
                'budgets' => $budgets,
                'events' => $events,
            ]);
        });
    }
}
