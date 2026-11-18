<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateNewsArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->is_active;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('title')) {
            $this->merge([
                'slug' => Str::slug($this->input('title')),
            ]);
        }

        if ($this->has('image_url') && trim((string) $this->input('image_url')) === '') {
            $this->merge(['image_url' => null]);
        }
    }

    public function rules(): array
    {
        $routeParam = $this->route('news_article') ?? $this->route('news');
        $newsId = is_object($routeParam) ? $routeParam->id : $routeParam;

        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => [
                'sometimes',
                'required',
                'string',
                Rule::unique('news_articles', 'slug')->ignore($newsId),
            ],
            'category' => ['sometimes', 'required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['nullable', 'string'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'date_string' => ['nullable', 'string', 'max:255'],
            'is_published' => ['sometimes', 'boolean'],
            'image_caption' => ['nullable', 'string', 'max:500'],
            'sub_images' => ['nullable', 'array', 'max:12'],
            'sub_images.*.url' => ['required', 'string', 'max:500'],
            'sub_images.*.caption' => ['nullable', 'string', 'max:500'],
        ];
    }
}
