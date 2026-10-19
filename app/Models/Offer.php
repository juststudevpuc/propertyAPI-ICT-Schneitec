<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['title', 'validity', 'description', 'image_url', 'cta_link', 'is_published', 'display_order'];
    protected $casts = ['is_published' => 'boolean'];
}
