<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Update your fillable array
    protected $fillable = [
        'title', 'category', 'excerpt', 'content', 'image_url', 'thumbnail_url', 'is_featured', 'status', 'user_id'
    ];

    // Add this new relationship method at the bottom of the class
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}