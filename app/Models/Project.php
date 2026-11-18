<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'tagline',
        'starting_price',
        'cover_image',
        'video_url',
        'overview',
        'design_approach',
        'highlights',
        'key_stats',
        'house_types',
        'amenities',
        'gallery_images',
        'progress_text',
        'progress_percent',
        'audit_label',
        'is_published',
    ];

    protected $casts = [
        'highlights'       => 'array',
        'key_stats'        => 'array',
        'house_types'      => 'array',
        'amenities'        => 'array',
        'gallery_images'   => 'array',
        'progress_percent' => 'integer',
        'is_published'     => 'boolean',
    ];

    public function gallery(): HasMany
    {
        return $this->hasMany(ProjectGallery::class);
    }
}
