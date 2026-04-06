<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Setting; // Adjust if your model name is different
use Illuminate\Http\Request;

class AppController extends Controller
{
    // 1. Get Site Settings (Logo, Radio Stream URL, Contact Info)
    public function settings()
    {
        $settings = Setting::first();
        return response()->json([
            'success' => true,
            'data' => $settings
        ]);
    }

    // 2. Get Latest News (For Homepage/Ticker)
    public function latestNews(Request $request)
    {
        // Removed the "with" relationships to test pure article retrieval
        $articles = Article::where('status', 'published')
            ->latest()
            ->take(15)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $articles
        ]);
    }

    // 3. Get Single Article Details
    public function singleArticle($id)
    {
        $article = Article::with(['category', 'user:id,name'])->find($id);

        if (!$article) {
            return response()->json(['success' => false, 'message' => 'Article not found'], 404);
        }

        // Increment view count if you have one
        // $article->increment('views');

        return response()->json([
            'success' => true,
            'data' => $article
        ]);
    }

    // 4. Get All Categories
    public function categories()
    {
        // Get categories that have published articles
        $categories = Category::withCount(['articles' => function($query) {
            $query->where('status', 'published');
        }])->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    // 5. Get News by Category
    public function categoryNews($categoryId)
    {
        $articles = Article::with(['category', 'user:id,name'])
            ->where('category_id', $categoryId)
            ->where('status', 'published')
            ->latest()
            ->paginate(10); // Use pagination for infinite scrolling in the app

        return response()->json([
            'success' => true,
            'data' => $articles
        ]);
    }
}