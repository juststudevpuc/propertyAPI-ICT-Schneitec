<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->is_active;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('title')) {
            $this->merge(['slug' => Str::slug($this->input('title'))]);
        }

        foreach (['cover_image', 'video_url', 'tagline', 'starting_price', 'progress_text', 'audit_label'] as $field) {
            if ($this->has($field) && trim((string) $this->input($field)) === '') {
                $this->merge([$field => null]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'title'                        => ['required', 'string', 'max:255'],
            'slug'                         => ['required', 'string', 'unique:projects,slug'],
            'category'                     => ['required', 'string', 'max:255'],
            'tagline'                      => ['nullable', 'string', 'max:255'],
            'starting_price'               => ['nullable', 'string', 'max:100'],
            'cover_image'                  => ['nullable', 'string', 'max:500'],
            'video_url'                    => ['nullable', 'string', 'max:500'],
            'overview'                     => ['nullable', 'string', 'max:2000'],
            'design_approach'              => ['nullable', 'string'],
            'highlights'                   => ['nullable', 'array'],
            'key_stats'                    => ['nullable', 'array', 'max:8'],
            'key_stats.*.value'            => ['required', 'string', 'max:100'],
            'key_stats.*.label'            => ['required', 'string', 'max:150'],
            'house_types'                  => ['nullable', 'array', 'max:12'],
            'house_types.*.name'           => ['required', 'string', 'max:150'],
            'house_types.*.subtitle'       => ['nullable', 'string', 'max:150'],
            'house_types.*.image'          => ['nullable', 'string', 'max:500'],
            'house_types.*.specs'          => ['nullable', 'array'],
            'house_types.*.specs.landArea'   => ['nullable', 'string', 'max:100'],
            'house_types.*.specs.usableArea' => ['nullable', 'string', 'max:100'],
            'house_types.*.specs.bedroom'    => ['nullable', 'string', 'max:100'],
            'house_types.*.specs.bathroom'   => ['nullable', 'string', 'max:100'],
            'house_types.*.specs.powderRoom' => ['nullable', 'string', 'max:100'],
            'house_types.*.specs.parking'    => ['nullable', 'string', 'max:100'],
            'amenities'                    => ['nullable', 'array', 'max:16'],
            'amenities.*.name'             => ['required', 'string', 'max:150'],
            'amenities.*.image'            => ['nullable', 'string', 'max:500'],
            'gallery_images'               => ['nullable', 'array', 'max:20'],
            'gallery_images.*.url'         => ['required', 'string', 'max:500'],
            'gallery_images.*.caption'     => ['nullable', 'string', 'max:255'],
            'progress_text'                => ['nullable', 'string', 'max:255'],
            'progress_percent'             => ['nullable', 'integer', 'min:0', 'max:100'],
            'audit_label'                  => ['nullable', 'string', 'max:150'],
            'is_published'                 => ['sometimes', 'boolean'],
        ];
    }
}
