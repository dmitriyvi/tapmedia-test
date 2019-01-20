<?php
namespace App\Providers;


use App\Interfaces\Uuid\UuidGeneratorInterface;
use App\Services\Uuid\UuidGenerator;
use Illuminate\Support\ServiceProvider;

class UuidServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UuidGeneratorInterface::class, UuidGenerator::class);
    }
}
