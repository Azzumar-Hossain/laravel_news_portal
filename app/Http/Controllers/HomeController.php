<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. HERO SECTION DATA
        $targetCategories = ['চাঁপাইনবাবগঞ্জ সদর', 'বাংলাদেশ', 'আন্তর্জাতিক', 'নাচোল', 'খেলাধুলা'];
        $heroBlocks = [];
        $heroArticleIds = []; 

        foreach ($targetCategories as $catName) {
            $article = Article::where('category', $catName)->where('status', 'published')->latest()->first();
            if ($article) {
                $heroBlocks[] = [
                    'category_name' => $catName,
                    'article' => $article
                ];
                $heroArticleIds[] = $article->id; 
            }
        }

        // 2. COLUMN 1: 'চাঁপাইনবাবগঞ্জ সদর'
        $chapaiArticles = Article::where('category', 'চাঁপাইনবাবগঞ্জ সদর')->where('status', 'published')->latest()->take(3)->get();

        // 3. COLUMN 2: 'বাংলাদেশ'
        $bangladeshArticles = Article::where('category', 'বাংলাদেশ')->where('status', 'published')->latest()->take(3)->get();

        // 4. COLUMN 3: Recent Posts
        $recentPosts = Article::where('status', 'published')->whereNotIn('id', $heroArticleIds)->latest()->take(4)->get();

        // 5. 2-COLUMN SECTION 1: 'আন্তর্জাতিক' and 'শিবগঞ্জ'
        $internationalArticles = Article::where('category', 'আন্তর্জাতিক')->where('status', 'published')->latest()->take(3)->get();
        $shibganjArticles = Article::where('category', 'শিবগঞ্জ')->where('status', 'published')->latest()->take(3)->get();

        // 6. NEW 2-COLUMN SECTION 2: 'বিনোদন' and 'খেলাধুলা'
        $entertainmentArticles = Article::where('category', 'বিনোদন')->where('status', 'published')->latest()->take(3)->get();
        $sportsArticles = Article::where('category', 'খেলাধুলা')->where('status', 'published')->latest()->take(3)->get();

        // 7. NEW 2-COLUMN SECTION 3: 'সম্পাদকীয়' and 'লাইফস্টাইল'
        $editorialArticles = Article::where('category', 'সম্পাদকীয়')->where('status', 'published')->latest()->take(3)->get();
        $lifestyleArticles = Article::where('category', 'লাইফস্টাইল')->where('status', 'published')->latest()->take(3)->get();

        // Update the compact() array to include the new variables!
        return view('home', compact(
            'heroBlocks', 'chapaiArticles', 'bangladeshArticles', 'recentPosts', 
            'internationalArticles', 'shibganjArticles', 'entertainmentArticles', 'sportsArticles',
            'editorialArticles', 'lifestyleArticles'
        ));
    }

    public function category($slug)
    {
        // Decode the URL so Bengali text is read perfectly
        $categoryName = urldecode($slug);

        // Fetch PUBLISHED articles for this category, but use pagination (10 per page)
        $articles = Article::where('category', $categoryName)
                           ->where('status', 'published')
                           ->latest()
                           ->paginate(10);

        // Fetch recent posts for the sidebar so the page doesn't look empty on the right
        $recentPosts = Article::where('status', 'published')->latest()->take(5)->get();

        return view('category', compact('articles', 'categoryName', 'recentPosts'));
    }

    public function show(Article $article)
    {
        // SECURITY: Prevent readers from guessing the URL of a draft
        if ($article->status !== 'published') {
            abort(404);
        }

        // Fetch 5 recent published articles for the sidebar (excluding the current one)
        $recentPosts = Article::where('status', 'published')
                              ->where('id', '!=', $article->id)
                              ->latest()
                              ->take(5)
                              ->get();

        // Fetch up to 4 related articles from the same category, excluding the current one
        $relatedArticles = Article::where('category', $article->category)
                            ->where('id', '!=', $article->id)
                            ->where('status', 'published')
                            ->latest()
                            ->take(4)
                            ->get();

        // ONE single return statement passing all three variables to the view!
        return view('article', compact('article', 'recentPosts', 'relatedArticles'));
    }
    
    // Handle the Search Bar queries
    public function search(Request $request)
    {
        $query = $request->input('q'); // 'q' is the name of our search input field

        // Search for published articles where the title OR content matches the keyword
        $articles = Article::where('status', 'published')
            ->where(function($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'LIKE', "%{$query}%")
                             ->orWhere('content', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->paginate(10); // Keep it paginated!

        // Fetch recent posts for the sidebar to keep the layout consistent
        $recentPosts = Article::where('status', 'published')->latest()->take(5)->get();

        // Return a specific search view (we will create this next)
        return view('search', compact('articles', 'query', 'recentPosts'));
    }
}