<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Show the category dashboard
    public function index()
    {
        // Change from ->get() to ->paginate(10) to show 10 categories per page
        $categories = Category::latest()->paginate(10);
        
        // Keep getting ALL main categories so your dropdown doesn't miss any options
        $mainCategories = Category::whereNull('parent_id')->get(); 
        
        return view('admin.categories.index', compact('categories', 'mainCategories'));
    }

    // Save a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id' // Validate the parent
        ]);

        Category::create([
            'name' => $request->name, // Removed strtoupper() so your Bengali fonts display correctly!
            'parent_id' => $request->parent_id
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    // Show the form to edit an existing category
    public function edit(Category $category)
    {
        // Fetch main categories for the dropdown, but exclude THIS category so it can't be its own parent!
        $mainCategories = Category::whereNull('parent_id')->where('id', '!=', $category->id)->get();
        
        return view('admin.categories.edit', compact('category', 'mainCategories'));
    }

    // Save the updated category back to the database
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'sort_order' => 'nullable|integer',
        ]);

        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // Delete a category
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}