<?php

namespace App\Providers;

use App\Instagram\InstagramApiStories;
use App\Instagram\InstagramApiUserData;
use App\Instagram\InstagramWebHighlights;
use App\Instagram\Interfaces\InstagramHighlightsInterface;
use App\Instagram\Interfaces\InstagramStoriesInterface;
use App\Instagram\Interfaces\InstagramUserDataInterface;
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
        $this->app->bind(InstagramStoriesInterface::class, InstagramApiStories::class);
        $this->app->bind(InstagramUserDataInterface::class, InstagramApiUserData::class);
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
