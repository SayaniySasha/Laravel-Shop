<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Contracts\PageContract;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PageContract::class, Page::class);
    }

    public function provides()
    {
        return [PageContract::class];
    }
}
