<?php

namespace App\Providers;

use App\Containers\ProductImport;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //incrementing ram for commands
        ini_set('memory_limit', '100000M');
        ini_set('max_execution_time', 180); //3 minutes


        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->singleton(ProductImport::class, function ($app) {
            return new ProductImport();
        });
    }
}
