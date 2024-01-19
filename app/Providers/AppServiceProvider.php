<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use ConsoleTVs\Charts\Registrar as Charts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $charts->register([
        //     \App\Charts\ChartDashboardOrtu::class
        // ]);
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
    }
}
