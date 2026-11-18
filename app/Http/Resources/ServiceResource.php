<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'section_type' => $this->section_type,
            'sort_order'   => $this->sort_order,
            'tabName'      => $this->tab_name ?? '',
            'title'        => $this->title,
            'subtitle'     => $this->subtitle ?? '',
            'intro'        => $this->intro ?? '',
            'bullets'      => $this->bullets ?? [],
            'footnote'     => $this->footnote ?? '',
            'image'        => $this->image_url ?? '',
            'contact'      => [
                'desk'  => $this->contact_desk ?? '',
                'phone' => $this->contact_phone ?? '',
                'email' => $this->contact_email ?? '',
                'hours' => $this->contact_hours ?? '',
            ],
        ];
    }
}
