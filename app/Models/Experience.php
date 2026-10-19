<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['category', 'title', 'description', 'image_url', 'cta_link', 'is_published', 'display_order'];
    protected $casts = ['is_published' => 'boolean'];
}
