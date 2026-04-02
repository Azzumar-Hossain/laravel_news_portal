<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\Models\Category;      
use Illuminate\Support\Facades\Gate;       
use App\Models\User;

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
        // Your existing category logic...
        View::composer('layouts.frontend', function ($view) {
            $view->with('navCategories', Category::whereNull('parent_id')->with('subcategories')->get());
        });

        // NEW: Share Settings with all layouts (both frontend and admin)
        View::composer('*', function ($view) {
            // We check if the table exists first to prevent migration errors
            if (Schema::hasTable('settings')) {
                $view->with('siteSetting', Setting::first());
            }
        });

        // NEW: Define the Admin Gate
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });
    }
}