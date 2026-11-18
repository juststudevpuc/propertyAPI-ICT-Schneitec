<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'date' => $this->date_string,
            'category' => $this->category,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'image' => $this->image_url,
            'coverImage' => $this->image_url,
            'image_caption' => $this->image_caption,
            'sub_images' => $this->sub_images ?? [],
        ];
    }
}
