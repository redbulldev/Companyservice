<?php

namespace Companyservice\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class ServiceTopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/admin.php');

        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->app->register(RepositoryServiceProvider::class);

        if ($this->app->runningInConsole()) {
            $this->publishResources();
        }
    }

    protected function publishResources()
    {
        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations'),
        ], 'database/migrations');
    }
}

