<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsApiController;

/*
|--------------------------------------------------------------------------
| Mobile App API Routes (Version 1)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->group(function () {
    Route::get('/settings', [NewsApiController::class, 'getSettings']);
    Route::get('/categories', [NewsApiController::class, 'getCategories']);
    
    Route::get('/news/latest', [NewsApiController::class, 'getLatestNews']);
    Route::get('/news/featured', [NewsApiController::class, 'getFeaturedNews']);
    Route::get('/news/category/{category}', [NewsApiController::class, 'getNewsByCategory']);
    Route::get('/news/details/{id}', [NewsApiController::class, 'getNewsDetails']);
    Route::get('/news/search', [NewsApiController::class, 'searchNews']);
});

