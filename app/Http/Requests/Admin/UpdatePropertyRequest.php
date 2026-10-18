<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdatePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->is_active;
    }

    protected function prepareForValidation()
    {
        if ($this->name) {
            $this->merge(['slug' => Str::slug($this->name)]);
        }
    }

    public function rules(): array
    {
        // Get the ID of the property being updated so we can ignore its own slug uniqueness
        $propertyId = $this->route('property')->id ?? $this->route('property');

        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['sometimes', 'required', 'string', 'unique:properties,slug,' . $propertyId],
            'category' => ['sometimes', 'required', 'string', 'max:255'],
            'location' => ['sometimes', 'required', 'string', 'max:255'],
            'starting_rate' => ['sometimes', 'required', 'numeric', 'min:0'],
            'overview' => ['sometimes', 'required', 'string', 'max:1000'],
            'description' => ['sometimes', 'required', 'string'],
            'amenities' => ['nullable', 'array'],
            'is_published' => ['boolean'],
        ];
    }
}
