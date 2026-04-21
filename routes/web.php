<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;

// 1. PUBLIC FRONTEND ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category');
Route::get('/article/{article}', [HomeController::class, 'show'])->name('article.show');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// ADD THIS NEW CONTACT ROUTE:
Route::get('/contact', function () {
    $siteSetting = \App\Models\Setting::first(); 
    return view('contact', compact('siteSetting'));
})->name('contact');

// ADD THIS NEW SEARCH ROUTE:
Route::get('/search', [HomeController::class, 'search'])->name('search');

// 2. PROFILE ROUTES (Breeze Default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================================================
// ROLE-BASED ACCESS CONTROL (RBAC) ROUTES
// =========================================================

// 3. EVERYONE LOGGED IN (Admins & Editors) CAN ACCESS THESE:
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Route (Your custom paginated closure)
    Route::get('/dashboard', function () {
        // Fetch articles, but only 10 per page
        $articles = Article::latest()->paginate(10); 
        return view('dashboard', compact('articles'));
    })->name('dashboard');

    // Admin CRUD Routes for Articles
    Route::resource('admin/articles', ArticleController::class);
});


// 4. STRICTLY ADMINS ONLY CAN ACCESS THESE:
Route::middleware(['auth', 'verified', 'can:admin'])->group(function () {
    
    // Category Routes
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');
    
    // ADD THESE TWO NEW ROUTES:
    Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    
    Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Site Settings Routes
    Route::get('/admin/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/admin/settings', [SettingController::class, 'update'])->name('settings.update');

    // User Management Routes
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
    
    // ADD THESE TWO NEW ROUTES:
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('users.update');
    
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

});

require __DIR__.'/auth.php';