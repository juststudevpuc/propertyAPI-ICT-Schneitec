<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() && $this->user()->is_active; }

    protected function prepareForValidation() {
        if ($this->title) $this->merge(['slug' => Str::slug($this->title)]);
    }

    public function rules(): array {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'unique:projects,slug'],
            'category' => ['required', 'string', 'max:255'],
            'overview' => ['required', 'string', 'max:1000'],
            'design_approach' => ['required', 'string'],
            'highlights' => ['nullable', 'array'],
            'is_published' => ['boolean'],
        ];
    }
}
