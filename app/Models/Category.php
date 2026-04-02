<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Added parent_id here
    protected $fillable = ['name', 'parent_id'];

    // Tell Laravel that a category can have many sub-categories
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}