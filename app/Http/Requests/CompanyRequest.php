<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'nullable',
                'email',
                // If it's an update, we skip the unique check for the 'email' field
                Rule::unique('employees', 'email')->ignore($this->route('company')), // Skips uniqueness check for the current company's email
            ],
            'logo' => 'nullable|image|dimensions:width=100,height=100|max:1024', // 1MB max
            'website' => 'nullable|url',
        ];

    }
}
