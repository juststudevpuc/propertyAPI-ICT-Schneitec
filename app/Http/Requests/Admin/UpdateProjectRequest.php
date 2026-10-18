<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() && $this->user()->is_active; }

    protected function prepareForValidation() {
        if ($this->title) $this->merge(['slug' => Str::slug($this->title)]);
    }

    public function rules(): array {
        $projectId = $this->route('project')->id ?? $this->route('project');
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['sometimes', 'required', 'string', 'unique:projects,slug,' . $projectId],
            'category' => ['sometimes', 'required', 'string', 'max:255'],
            'overview' => ['sometimes', 'required', 'string', 'max:1000'],
            'design_approach' => ['sometimes', 'required', 'string'],
            'highlights' => ['nullable', 'array'],
            'is_published' => ['boolean'],
        ];
    }
}
