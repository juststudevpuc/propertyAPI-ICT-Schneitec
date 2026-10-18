<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $coverImage = $this->gallery->where('label', 'Cover')->first();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category,
            'image' => $coverImage ? $coverImage->image_url : null,
            'gallery' => $this->gallery->map(function ($item) {
                return [
                    'src' => $item->image_url,
                    'label' => $item->label
                ];
            })->values(),
            'overview' => $this->overview,
            'designApproach' => $this->design_approach,
            'highlights' => is_string($this->highlights) ? json_decode($this->highlights) : $this->highlights,
        ];
    }
}
