<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppController;

Route::prefix('v1')->group(function () {
    Route::get('/settings', [AppController::class, 'settings']);
    Route::get('/news/latest', [AppController::class, 'latestNews']);
    Route::get('/news/{id}', [AppController::class, 'singleArticle']);
    Route::get('/categories', [AppController::class, 'categories']);
    Route::get('/categories/{id}/news', [AppController::class, 'categoryNews']);

    // Add this new route for the mobile app contact form
    Route::post('/contact', [AppController::class, 'submitContact']);
});

