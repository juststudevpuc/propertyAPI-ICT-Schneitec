<?php

namespace App\Http\Requests\Admin;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->is_active;
    }

    protected function prepareForValidation(): void
    {
        $nullableFields = [
            'tab_name', 'subtitle', 'intro', 'footnote',
            'image_url', 'contact_desk', 'contact_phone',
            'contact_email', 'contact_hours',
        ];

        foreach ($nullableFields as $field) {
            if ($this->has($field) && trim((string) $this->input($field)) === '') {
                $this->merge([$field => null]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'section_type'  => ['sometimes', 'required', 'string', Rule::in([Service::TYPE_CARE_SLIDE, Service::TYPE_BROKERAGE_PROTOCOL])],
            'sort_order'    => ['sometimes', 'integer', 'min:0', 'max:999'],
            'tab_name'      => ['nullable', 'string', 'max:255'],
            'title'         => ['sometimes', 'required', 'string', 'max:255'],
            'subtitle'      => ['nullable', 'string', 'max:255'],
            'intro'         => ['nullable', 'string', 'max:3000'],
            'bullets'       => ['nullable', 'array', 'max:15'],
            'bullets.*'     => ['required', 'string', 'max:1000'],
            'footnote'      => ['nullable', 'string', 'max:500'],
            'image_url'     => ['nullable', 'string', 'max:500'],
            'contact_desk'  => ['nullable', 'string', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:100'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_hours' => ['nullable', 'string', 'max:150'],
            'is_published'  => ['sometimes', 'boolean'],
        ];
    }
}
