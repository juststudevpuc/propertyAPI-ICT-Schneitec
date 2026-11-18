<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public const TYPE_CARE_SLIDE = 'care_slide';
    public const TYPE_BROKERAGE_PROTOCOL = 'brokerage_protocol';

    protected $fillable = [
        'section_type',
        'sort_order',
        'tab_name',
        'title',
        'subtitle',
        'intro',
        'bullets',
        'footnote',
        'image_url',
        'contact_desk',
        'contact_phone',
        'contact_email',
        'contact_hours',
        'is_published',
    ];

    protected $casts = [
        'sort_order'   => 'integer',
        'bullets'      => 'array',
        'is_published' => 'boolean',
    ];

    /* ─── Reusable Query Scopes ─────────────────────────────── */

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }

    public function scopeOfSection(Builder $query, string $type): Builder
    {
        return $query->where('section_type', $type);
    }
}
