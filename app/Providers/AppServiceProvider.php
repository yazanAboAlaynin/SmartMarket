<?php

namespace App\Providers;

use App\Brand;
use App\Category;
use App\Notification;
use App\Vendor;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('numberAlert',Notification::numberAlert());
        View::share('category',Category::all());
        View::share('brands',Brand::all());
        View::share('sellers',Vendor::all());
    }
}
