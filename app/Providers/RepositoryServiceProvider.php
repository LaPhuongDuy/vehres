<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\Repositories\Contracts\GarageRepositoryInterface;
use App\Repositories\Eloquent\GarageRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(GarageRepositoryInterface::class, GarageRepository::class);
    }
}
