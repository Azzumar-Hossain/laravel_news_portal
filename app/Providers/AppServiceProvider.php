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
        // 1. Share Categories with Frontend Layout (Sorted by Admin Input)
        View::composer('layouts.frontend', function ($view) {
            $navCategories = Category::whereNull('parent_id')
                ->with(['subcategories' => function ($query) {
                    $query->orderBy('sort_order', 'asc'); // Sorts the dropdown items
                }])
                ->orderBy('sort_order', 'asc') // Sorts the main navigation tabs
                ->get();
                
            $view->with('navCategories', $navCategories);
        });

        // 2. Share Settings with all layouts (both frontend and admin)
        View::composer('*', function ($view) {
            // Check if the table exists first to prevent migration errors
            if (Schema::hasTable('settings')) {
                $view->with('siteSetting', Setting::first());
            }
        });

        // 3. Define the Admin Gate
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });
    }
}