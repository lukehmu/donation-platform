<?php

namespace App\Providers;

use App\Repositories\DonationRepository;
use App\Repositories\Interfaces\DonationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            DonationRepositoryInterface::class,
            DonationRepository::class

        );
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
