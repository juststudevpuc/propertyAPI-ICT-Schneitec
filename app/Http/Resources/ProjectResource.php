<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $legacyCover = $this->relationLoaded('gallery')
            ? optional($this->gallery->where('label', 'Cover')->first())->image_url
            : null;

        $cover = $this->cover_image ?: $legacyCover;

        $conceptText = array_values(array_filter([
            $this->overview,
            $this->design_approach,
        ], fn ($v) => is_string($v) && trim($v) !== ''));

        $gallery = !empty($this->gallery_images)
            ? collect($this->gallery_images)->map(fn ($item) => [
                'url'     => $item['url'] ?? '',
                'caption' => $item['caption'] ?? '',
            ])->filter(fn ($item) => $item['url'] !== '')->values()
            : ($this->relationLoaded('gallery')
                ? $this->gallery->map(fn ($item) => [
                    'url'     => $item->image_url,
                    'caption' => $item->label ?? '',
                ])->values()
                : []);

        return [
            'id'              => $this->id,
            'slug'            => $this->slug,
            'name'            => $this->title,
            'title'           => $this->title,
            'category'        => $this->category,
            'tagline'         => $this->tagline,
            'startingPrice'   => $this->starting_price,
            'coverImage'      => $cover,
            'image'           => $cover,
            'videoUrl'        => $this->video_url,
            'overview'        => $this->overview,
            'designApproach'  => $this->design_approach,
            'conceptText'     => $conceptText,
            'keyStats'        => $this->key_stats ?? [],
            'houseTypes'      => $this->house_types ?? [],
            'amenities'       => $this->amenities ?? [],
            'gallery'         => $gallery,
            'progressText'    => $this->progress_text,
            'progressPercent' => $this->progress_percent ?? 100,
            'auditLabel'      => $this->audit_label,
        ];
    }
}
