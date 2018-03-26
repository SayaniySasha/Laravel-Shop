<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ArticlesRepository;
use App\Repositories\EloquentArticlesRepository;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use App\Repositories\ElasticsearchArticlesRepository;

class RepositoryServiceProvider extends ServiceProvider
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
        // $this->app->bind(\App\Repositories\ArticlesRepository::class, function () {
        //     return new EloquentArticlesRepository();
        // });


        $this->app->singleton(ArticlesRepository::class, function($app) {
            if (!config('services.search.enabled')) {
                return new EloquentArticlesRepository();
            }
            return new ElasticsearchArticlesRepository(
                $app->make(Client::class)
            );
        });
        
        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts(config('services.search.hosts'))
                ->build();
        });
    }
}
