<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Product;
use App\Brand;
use Cart;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $categories = Category::get();
            $brands = Brand::get();
            $view->with('categories', $categories);
        });
        view()->composer('*',function($view){
            $brands = Brand::get();
            $view->with('brands', $brands);
        });
        view()->composer('*', function($view){
            $cart = Cart::content();
            $view->with('cart', $cart);
        });
       
            view()->composer('*', function($view){
                $view->with('user', Session::get('user'));
            });
       
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
