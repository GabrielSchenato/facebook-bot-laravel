<?php

namespace FacebookBot\Providers;

use Illuminate\Support\ServiceProvider;
use FacebookBot\Product;
use FacebookBot\Observers\ProductObserver;

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
