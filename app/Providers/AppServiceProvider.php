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
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $setting = \Illuminate\Support\Facades\Cache::remember('view_setting', 3600, function () {
                try {
                    return \App\Models\Setting::first();
                } catch (\Throwable $e) {
                    return null;
                }
            });

            $demographics = \Illuminate\Support\Facades\Cache::remember('view_demographics', 3600, function () {
                try {
                    return \App\Models\Demographic::all();
                } catch (\Throwable $e) {
                    return collect();
                }
            });

            $budgets = \Illuminate\Support\Facades\Cache::remember('view_budgets', 3600, function () {
                try {
                    return \App\Models\Budget::all();
                } catch (\Throwable $e) {
                    return collect();
                }
            });

            $events = \Illuminate\Support\Facades\Cache::remember('view_events', 3600, function () {
                try {
                    return \App\Models\Event::orderBy('date', 'asc')->get();
                } catch (\Throwable $e) {
                    return collect();
                }
            });

            $viewData = [
                'setting' => $setting,
                'demographics' => $demographics,
                'budgets' => $budgets,
            ];

            if (!$view->offsetExists('events')) {
                $viewData['events'] = $events;
            }

            $view->with($viewData);
        });
    }
}
