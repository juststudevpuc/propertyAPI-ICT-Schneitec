<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Find the cover image from the gallery
        $coverImage = $this->gallery->where('label', 'Cover')->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'location' => $this->location,
            'image' => $coverImage ? $coverImage->image_url : null,
            'gallery' => $this->gallery->map(function ($item) {
                return [
                    'src' => $item->image_url,
                    'label' => $item->label
                ];
            })->values(),
            'overview' => $this->overview,
            'description' => $this->description,
            // Decode the JSON so React gets a real array
            'amenities' => is_string($this->amenities) ? json_decode($this->amenities) : $this->amenities,
            'startingRate' => (int) $this->starting_rate,
        ];
    }
}
