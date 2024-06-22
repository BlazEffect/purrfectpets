<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\BrandService;
use App\Services\EmailService;
use App\Services\MenuService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AuthService::class, fn() => new AuthService());
        $this->app->singleton(EmailService::class, fn() => new EmailService());
        $this->app->singleton(BrandService::class, fn() => new BrandService());
        $this->app->singleton(MenuService::class, fn() => new MenuService());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
