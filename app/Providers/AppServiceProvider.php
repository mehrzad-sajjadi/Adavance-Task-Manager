<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        App::setLocale("fa");
        //Gate::define("نام Gate",function(){
        //     return True/False ; 
        // })

        Gate::define("show_category",function($user,$category){
            return  $user->id == $category->user_id ;
        });
        
    }
}
