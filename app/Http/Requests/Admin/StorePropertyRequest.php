<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->is_active;
    }

    protected function prepareForValidation()
    {
        // Automatically generate a URL-friendly slug from the name
        if ($this->name) {
            $this->merge(['slug' => Str::slug($this->name)]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'unique:properties,slug'],
            'category' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'starting_rate' => ['required', 'numeric', 'min:0'],
            'overview' => ['required', 'string', 'max:1000'],
            'description' => ['required', 'string'],
            'amenities' => ['nullable', 'array'],
            'is_published' => ['boolean'],
        ];
    }
}
