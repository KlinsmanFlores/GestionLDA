<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Usuario;
use App\Observers\UsuarioObserver;
use App\Services\LogisticaService;
use App\Services\OrderCalculationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(LogisticaService::class, function($app) {
        return new LogisticaService(
            $app->make(OrderCalculationService::class)
        );
    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
