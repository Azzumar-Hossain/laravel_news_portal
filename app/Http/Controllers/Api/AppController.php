<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;

class AppController extends Controller
{
    // 1. Get Site Settings
    public function settings()
    {
        $settings = Setting::first();
        
        // Ensure the logo gets the full website URL
        if ($settings && $settings->site_logo) {
            $settings->site_logo = asset($settings->site_logo);
        }

        return response()->json([
            'success' => true,
            'data' => $settings
        ]);
    }

    // 2. Get Latest News
    public function latestNews(Request $request)
    {
        $articles = Article::where('status', 'published')
            ->latest()
            ->take(15)
            ->get()
            ->map(function ($article) {
                // Attach full URLs and apply the category mask
                $article->image_url = $article->image_url ? asset($article->image_url) : null;
                $article->category = $article->category == 'বাংলাদেশ' ? 'জাতীয়' : $article->category;
                return $article;
            });

        return response()->json([
            'success' => true,
            'data' => $articles
        ]);
    }

    // 3. Get Single Article Details
    public function singleArticle($id)
    {
        // Removed 'user' relationship to hide publisher name as you requested earlier!
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['success' => false, 'message' => 'Article not found'], 404);
        }

        // Apply full URL and mask
        $article->image_url = $article->image_url ? asset($article->image_url) : null;
        $article->category = $article->category == 'বাংলাদেশ' ? 'জাতীয়' : $article->category;

        return response()->json([
            'success' => true,
            'data' => $article
        ]);
    }

    // 4. Get All Categories
    public function categories()
    {
        $categories = Category::withCount(['articles' => function($query) {
            $query->where('status', 'published');
        }])->get()->map(function ($cat) {
            // Apply category mask to the category list
            $cat->name = $cat->name == 'বাংলাদেশ' ? 'জাতীয়' : $cat->name;
            return $cat;
        });

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    // 5. Get News by Category
    public function categoryNews($categoryId)
    {
        $articles = Article::where('category_id', $categoryId)
            ->where('status', 'published')
            ->latest()
            ->paginate(10);

        // Fix the items inside the paginator
        $articles->getCollection()->transform(function ($article) {
            $article->image_url = $article->image_url ? asset($article->image_url) : null;
            $article->category = $article->category == 'বাংলাদেশ' ? 'জাতীয়' : $article->category;
            return $article;
        });

        return response()->json([
            'success' => true,
            'data' => $articles
        ]);
    }
}