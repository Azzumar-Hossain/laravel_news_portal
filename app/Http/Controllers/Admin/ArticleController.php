<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Intervention\Image\Laravel\Facades\Image; 
use Illuminate\Support\Facades\Storage; 

class ArticleController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get(); 
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|string',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', 
        ]);

        $validatedData['is_featured'] = $request->has('is_featured');
        $validatedData['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            
            // FIXED: Save the main image to image_url
            $validatedData['image_url'] = '/storage/' . $imagePath;
            
            // Ensure the thumbnails directory exists before saving!
            Storage::disk('public')->makeDirectory('articles/thumbnails');

            $thumbnailFileName = 'thumb_' . $request->file('image')->hashName(); 
            $thumbnailPath = 'articles/thumbnails/' . $thumbnailFileName; 

            // FIXED: Uncommented V3 Image Resizing so the thumbnail actually generates
            Image::read(storage_path('app/public/' . $imagePath))
                ->cover(64, 48) // 'cover' replaces 'fit' in V3
                ->save(storage_path('app/public/' . $thumbnailPath));

            $validatedData['thumbnail_url'] = '/storage/' . $thumbnailPath;
        }

        Article::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Article saved successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Article $article)
    {
        $categories = Category::orderBy('name')->get(); 
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required|string',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', 
        ]);

        $validatedData['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validatedData['image_url'] = '/storage/' . $imagePath;

            // Ensure the thumbnails directory exists before saving!
            Storage::disk('public')->makeDirectory('articles/thumbnails');

            $thumbnailFileName = 'thumb_' . $request->file('image')->hashName(); 
            $thumbnailPath = 'articles/thumbnails/' . $thumbnailFileName; 

            // V3 Image Resizing
            Image::read(storage_path('app/public/' . $imagePath))
                ->cover(64, 48)
                ->save(storage_path('app/public/' . $thumbnailPath));

            $validatedData['thumbnail_url'] = '/storage/' . $thumbnailPath;
        }

        $article->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Article updated successfully!');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('dashboard')->with('success', 'Article deleted successfully!');
    }
}