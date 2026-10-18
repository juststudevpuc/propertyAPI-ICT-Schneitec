<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UploadMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->is_active;
    }

    public function rules(): array
    {
        return [
            'file'      => ['required', 'file', 'mimes:jpg,jpeg,png,webp,svg,mp4,pdf', 'max:20480'], // Max 20MB
            'alt_text'  => ['nullable', 'string', 'max:255'],
            'subfolder' => ['nullable', 'string', 'max:50', 'alpha_dash'],
        ];
    }
}
