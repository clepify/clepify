<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLetterRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'date-picker-date' => ['required', 'string'],
      'duration' => ['required', 'numeric'],
      'type' => ['required', 'string'],
      'category' => ['required', 'string'],
      'multi-select-lecturer' => ['required', 'array'],
      'letter_document' => ['required', 'file', 'mimes:pdf', 'max:2048'],
      'support_document' => ['file', 'mimes:pdf', 'max:2048'],
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'multi-select-lecturer.required' => 'The lecturer field is required.',
    ];
  }
}
