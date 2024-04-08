<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\RepositoryInterface\UsersRepositoryInterface;
use App\RepositoryInterface\apiRepositoryInterface;
use  App\Services\UsersServicesRepository;
use App\Services\ApiServicesRepository;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UsersRepositoryInterface::class,UsersServicesRepository::class);
        $this->app->bind(apiRepositoryInterface::class,ApiServicesRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
