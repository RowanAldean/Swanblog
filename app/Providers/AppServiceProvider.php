<?php

namespace App\Providers;

use App\Services\Feed;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Feed::class, function ($app) {
            return new Feed('AAAAAAAAAAAAAAAAAAAAAGMfbwEAAAAAev0dZHJBINjuqoKz4fPMtvIcmEs%3D68AoDm9GGjHlRSP8UJ0aFKE8zsw6xZqVTId4M8H6oKNLty1Lpb');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
