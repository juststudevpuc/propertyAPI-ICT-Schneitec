<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuestFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Public form, anyone can submit
    }

    public function rules(): array
    {
        return [
            'hotel_visited' => ['nullable', 'string', 'max:255'],
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255'],
            'message'       => ['required', 'string', 'max:5000'],
        ];
    }
}
