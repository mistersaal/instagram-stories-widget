<?php

namespace App\Providers;

use App\Instagram\InstagramWebHighlights;
use App\Instagram\Interfaces\InstagramHighlightsInterface;
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
        $this->app->bind(InstagramHighlightsInterface::class, InstagramWebHighlights::class);
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
