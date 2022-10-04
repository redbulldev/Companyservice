<?php

namespace Companyservice\Providers;

use Illuminate\Support\ServiceProvider;

use Companyservice\Repositories\Eloquents\ServiceRepository;
use Companyservice\Repositories\Contracts\ServiceRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ServiceRepositoryInterface::class,ServiceRepository::class);
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

