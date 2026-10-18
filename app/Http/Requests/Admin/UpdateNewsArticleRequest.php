<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateNewsArticleRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() && $this->user()->is_active; }

    protected function prepareForValidation() {
        if ($this->title) $this->merge(['slug' => Str::slug($this->title)]);
    }

    public function rules(): array {
        $newsId = $this->route('news_article')->id ?? $this->route('news_article');
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['sometimes', 'required', 'string', 'unique:news_articles,slug,' . $newsId],
            'category' => ['sometimes', 'required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['nullable', 'string'],
            'image_url' => ['nullable', 'string', 'url'],
            'date_string' => ['nullable', 'string', 'max:255'],
            'is_published' => ['boolean'],
        ];
    }
}
