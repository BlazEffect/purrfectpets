<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\BrandService;
use App\Services\EmailService;
use App\Services\MenuService;
use App\Services\OrderService;
use App\Services\PageService;
use App\Services\ProductService;
use App\Services\ReviewService;
use App\Services\SectionService;
use App\Services\UserService;
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
        $this->app->singleton(OrderService::class, function ($app) {
            return new OrderService(
                $app->make(ProductService::class),
                $app->make(EmailService::class)
            );
        });
        $this->app->singleton(ProductService::class, fn() => new ProductService());
        $this->app->singleton(PageService::class, fn() => new PageService());
        $this->app->singleton(ReviewService::class, fn() => new ReviewService());
        $this->app->singleton(SectionService::class, fn() => new SectionService());
        $this->app->singleton(UserService::class, fn() => new UserService());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
