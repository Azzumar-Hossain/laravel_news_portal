<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class NewsApiController extends Controller
{
    /**
     * 1. Get Site Settings
     */
    public function getSettings()
    {
        try {
            $settings = DB::table('settings')->first(); 
            
            if ($settings && isset($settings->site_logo)) {
                if (!filter_var($settings->site_logo, FILTER_VALIDATE_URL)) {
                    $settings->site_logo = asset($settings->site_logo);
                }
            }

            return response()->json([
                'success' => true,
                'data' => $settings
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * 2. Get All Categories & Subcategories
     */
    public function getCategories()
    {
        try {
            $categories = Category::with('subcategories')->get();

            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * 3. Get Latest News (Paginated)
     */
    public function getLatestNews(Request $request)
    {
        try {
            $limit = (int) ($request->limit ?? 10);
            
            $news = Article::where('status', 'published')
                ->latest()
                ->paginate($limit);

            // Format Image URLs safely without $this scope issues
            $news->getCollection()->transform(function ($article) {
                if ($article->image_url && !filter_var($article->image_url, FILTER_VALIDATE_URL)) {
                    $article->image_url = asset($article->image_url);
                }
                if ($article->thumbnail_url && !filter_var($article->thumbnail_url, FILTER_VALIDATE_URL)) {
                    $article->thumbnail_url = asset($article->thumbnail_url);
                }
                return $article;
            });

            return response()->json([
                'success' => true,
                'data' => $news
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * 4. Get Featured News (Slider for Mobile App)
     */
    public function getFeaturedNews()
    {
        try {
            $news = Article::where('status', 'published')
                ->where('is_featured', true)
                ->latest()
                ->take(5)
                ->get();

            $news->transform(function ($article) {
                if ($article->image_url && !filter_var($article->image_url, FILTER_VALIDATE_URL)) {
                    $article->image_url = asset($article->image_url);
                }
                if ($article->thumbnail_url && !filter_var($article->thumbnail_url, FILTER_VALIDATE_URL)) {
                    $article->thumbnail_url = asset($article->thumbnail_url);
                }
                return $article;
            });

            return response()->json([
                'success' => true,
                'data' => $news
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * 5. Get News by Category Name
     */
    public function getNewsByCategory(Request $request, $category)
    {
        try {
            $limit = (int) ($request->limit ?? 10);
            
            $news = Article::where('status', 'published')
                ->where('category', $category)
                ->latest()
                ->paginate($limit);

            $news->getCollection()->transform(function ($article) {
                if ($article->image_url && !filter_var($article->image_url, FILTER_VALIDATE_URL)) {
                    $article->image_url = asset($article->image_url);
                }
                if ($article->thumbnail_url && !filter_var($article->thumbnail_url, FILTER_VALIDATE_URL)) {
                    $article->thumbnail_url = asset($article->thumbnail_url);
                }
                return $article;
            });

            return response()->json([
                'success' => true,
                'data' => $news
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * 6. Get Single News Details (With Content)
     */
    public function getNewsDetails($id)
    {
        try {
            $article = Article::with('user:id,name')->find($id);

            if (!$article || $article->status !== 'published') {
                return response()->json([
                    'success' => false,
                    'message' => 'Article not found'
                ], 404);
            }

            if ($article->image_url && !filter_var($article->image_url, FILTER_VALIDATE_URL)) {
                $article->image_url = asset($article->image_url);
            }
            if ($article->thumbnail_url && !filter_var($article->thumbnail_url, FILTER_VALIDATE_URL)) {
                $article->thumbnail_url = asset($article->thumbnail_url);
            }

            return response()->json([
                'success' => true,
                'data' => $article
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * 7. Search News
     */
    public function searchNews(Request $request)
    {
        try {
            $query = $request->q;
            $limit = (int) ($request->limit ?? 15);

            if (!$query) {
                return response()->json(['success' => false, 'message' => 'Search query is required'], 400);
            }

            $news = Article::where('status', 'published')
                ->where(function($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('content', 'LIKE', "%{$query}%")
                      ->orWhere('category', 'LIKE', "%{$query}%");
                })
                ->latest()
                ->paginate($limit);

            $news->getCollection()->transform(function ($article) {
                if ($article->image_url && !filter_var($article->image_url, FILTER_VALIDATE_URL)) {
                    $article->image_url = asset($article->image_url);
                }
                if ($article->thumbnail_url && !filter_var($article->thumbnail_url, FILTER_VALIDATE_URL)) {
                    $article->thumbnail_url = asset($article->thumbnail_url);
                }
                return $article;
            });

            return response()->json([
                'success' => true,
                'data' => $news
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}