<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    protected $fillable = [
        'title', 'slug', 'category', 'excerpt',
        'content', 'image_url', 'date_string', 'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
