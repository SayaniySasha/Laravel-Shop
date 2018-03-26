<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Breadcrumbs;

class BreadcrumsServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'Breadcrumbs', 
            function ($app) {
            return new Breadcrumbs();
            }
        );

    }
   
}
