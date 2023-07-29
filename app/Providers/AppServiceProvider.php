<?php

namespace App\Providers;

use App\Services\AuthService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\SaleService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*******************************************
         *            Services Binding             *
         *******************************************/

        App::bind(AuthService::class, function () {
            return new AuthService();
        });

        App::bind(CategoryService::class, function () {
            return new CategoryService();
        });

        App::bind(ProductService::class, function () {
            return new ProductService();
        });

        App::bind(SaleService::class, function () {
            return new SaleService();
        });
    }
}
