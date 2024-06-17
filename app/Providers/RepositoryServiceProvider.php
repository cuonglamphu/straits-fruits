<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Interfaces\CategoryRepositoryInterface',
            'App\Repositories\CategoryRepository'
        );
        $this->app->bind(
            'App\Interfaces\FruitRepositoryInterface',
            'App\Repositories\FruitRepository'
        );
        $this->app->bind(
            'App\Interfaces\InvoiceRepositoryInterface',
            'App\Repositories\InvoiceRepository'
        );
        $this->app->bind(
            'App\Interfaces\UnitRepositoryInterface',
            'App\Repositories\UnitRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
