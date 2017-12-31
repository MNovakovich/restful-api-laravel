<?php

namespace App\Providers;
use App\User;
use App\Models\Product;
use App\Mail\UserCreated;
use Illuminate\Support\Facades\Mail;
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
        
        /*User::create(function($user){
            Mail::to($user)->send(new UserCreated($user));
        });*/

        /*Product::update(function($product){
            if ($product->quantity == 0 && $product->isAvailable()) {
                 $product->status = Product::UNAVAILABLE_PRODUCT;

                 $product->save();
            }
        });*/
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
