<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'category', 'overview',
        'design_approach', 'highlights', 'is_published'
    ];

    protected $casts = [
        'highlights' => 'array',
        'is_published' => 'boolean',
    ];

    public function gallery(): HasMany
    {
        return $this->hasMany(ProjectGallery::class);
    }
}
