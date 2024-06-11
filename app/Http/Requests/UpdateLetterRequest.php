<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLetterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'type' => ['required', 'string'],
            'category' => ['required', 'string'],
            'letter_document' => ['file', 'mimes:pdf', 'max:2048'],
            'support_document' => ['file', 'mimes:pdf', 'max:2048'],
        ];
    }
}
