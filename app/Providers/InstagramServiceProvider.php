<?php

namespace App\Providers;

use App\Instagram\InstagramWebHighlights;
use App\Instagram\Interfaces\InstagramHighlightsInterface;
use Illuminate\Support\ServiceProvider;

class InstagramServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(InstagramHighlightsInterface::class, InstagramWebHighlights::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
