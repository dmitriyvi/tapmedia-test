<?php

namespace App\Providers;

use App\Interfaces\BadDomain\BadDomainRepositoryInterface;
use App\Interfaces\Click\ClickRepositoryInterface;
use App\Repository\DoctrineBadDomainRepository;
use App\Repository\DoctrineClickRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClickRepositoryInterface::class, DoctrineClickRepository::class);
        $this->app->bind(BadDomainRepositoryInterface::class, DoctrineBadDomainRepository::class);
    }
}
