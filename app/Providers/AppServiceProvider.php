<?php

namespace App\Providers;

use App\Brand;
use App\Category;
use App\Order_item;
use App\Vendor;
use Illuminate\Support\Facades\DB;
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
        View::share('numberAlert',0);
        View::share('category',Category::all());
        View::share('brands',Brand::all());
        $orders = Order_item::select('product_id',DB::raw('COUNT(id) as cnt'))->groupBy('product_id')->orderBy('cnt', 'DESC')->take(5)->get();
        //dd($orders);
        $sellers = [];
        foreach ($orders as $order){
            array_push($sellers,$order->product()->get()[0]->vendor()->get()[0]);
        }

        View::share('sellers',array_unique($sellers));

    }
}
