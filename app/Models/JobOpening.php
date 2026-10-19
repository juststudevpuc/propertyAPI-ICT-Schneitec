<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    protected $fillable = ['title', 'department', 'location', 'type', 'apply_link', 'is_published', 'display_order'];
    protected $casts = ['is_published' => 'boolean'];
}
