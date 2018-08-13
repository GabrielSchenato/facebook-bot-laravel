<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Product;
use App\Observers\ProductObserver;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
