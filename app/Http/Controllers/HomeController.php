<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. HERO SECTION (Left Side Slider) - strictly "চাঁপাইনবাবগঞ্জ সদর"
        $sliderArticles = Article::where('category', 'চাঁপাইনবাবগঞ্জ সদর')
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get();
            
        $sliderArticleIds = $sliderArticles->pluck('id')->toArray();

        // 2. HERO SECTION (Right Side Grid) - Specific Categories
        $gridCategories = ['বাংলাদেশ', 'আন্তর্জাতিক', 'নাচোল', 'খেলাধুলা'];
        $gridArticles = collect(); // Use a Laravel collection to store them
        $gridArticleIds = [];

        // Loop through and get 1 latest article for each of the 4 grid categories
        foreach ($gridCategories as $catName) {
            $article = Article::where('category', $catName)
                ->where('status', 'published')
                // Don't accidentally grab an article if it's already in the slider
                ->whereNotIn('id', $sliderArticleIds) 
                ->latest()
                ->first();
                
            if ($article) {
                $gridArticles->push($article);
                $gridArticleIds[] = $article->id; 
            }
        }

        // Keep track of all hero IDs so we don't duplicate them in the "Recent News" section below
        $heroArticleIds = array_merge($sliderArticleIds, $gridArticleIds);

        // 3. TOP ROW: 'বাংলাদেশ', 'আন্তর্জাতিক', and Recent Posts
        $bangladeshArticles = Article::where('category', 'বাংলাদেশ')->where('status', 'published')->latest()->take(3)->get();
        $internationalArticles = Article::where('category', 'আন্তর্জাতিক')->where('status', 'published')->latest()->take(3)->get();
        $recentPosts = Article::where('status', 'published')->whereNotIn('id', $heroArticleIds)->latest()->take(4)->get();

        // 4. MIDDLE ROW: 'বিজ্ঞান ও প্রযুক্তি' and 'বিনোদন'
        $techArticles = Article::where('category', 'বিজ্ঞান ও প্রযুক্তি')->where('status', 'published')->latest()->take(3)->get();
        $entertainmentArticles = Article::where('category', 'বিনোদন')->where('status', 'published')->latest()->take(3)->get();
        
        // 5. BOTTOM ROW: 'খেলাধুলা', 'সম্পাদকীয়', and 'লাইফস্টাইল'
        $sportsArticles = Article::where('category', 'খেলাধুলা')->where('status', 'published')->latest()->take(3)->get();
        $editorialArticles = Article::where('category', 'সম্পাদকীয়')->where('status', 'published')->latest()->take(3)->get();
        $lifestyleArticles = Article::where('category', 'লাইফস্টাইল')->where('status', 'published')->latest()->take(3)->get();

        // Pass all variables to the view
        return view('home', compact(
            'sliderArticles', 'gridArticles',
            'bangladeshArticles', 'internationalArticles', 'recentPosts', 
            'techArticles', 'entertainmentArticles', 'sportsArticles',
            'editorialArticles', 'lifestyleArticles'
        ));
    }

    public function category($slug)
    {
        $categoryName = urldecode($slug);

        $articles = Article::where('category', $categoryName)
                           ->where('status', 'published')
                           ->latest()
                           ->paginate(10);

        $recentPosts = Article::where('status', 'published')->latest()->take(5)->get();

        return view('category', compact('articles', 'categoryName', 'recentPosts'));
    }

    public function show(Article $article)
    {
        if ($article->status !== 'published') {
            abort(404);
        }

        $recentPosts = Article::where('status', 'published')
                              ->where('id', '!=', $article->id)
                              ->latest()
                              ->take(5)
                              ->get();

        $relatedArticles = Article::where('category', $article->category)
                            ->where('id', '!=', $article->id)
                            ->where('status', 'published')
                            ->latest()
                            ->take(4)
                            ->get();

        return view('article', compact('article', 'recentPosts', 'relatedArticles'));
    }
    
    public function search(Request $request)
    {
        $query = $request->input('q'); 

        $articles = Article::where('status', 'published')
            ->where(function($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'LIKE', "%{$query}%")
                             ->orWhere('content', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->paginate(10); 

        $recentPosts = Article::where('status', 'published')->latest()->take(5)->get();

        return view('search', compact('articles', 'query', 'recentPosts'));
    }
}