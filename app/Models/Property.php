<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $fillable = [
        'name', 'slug', 'category', 'location', 
        'starting_rate', 'overview', 'description', 'amenities',
        'is_published'
    ];

    // This is the missing relationship
    public function gallery(): HasMany
    {
        return $this->hasMany(PropertyGallery::class);
    }
}
