<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class EmployeeRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string',
            'company_id' => 'required|exists:companies,id', // 1MB max
            'email' => [
                'nullable',
                'email',
                // If it's an update, we skip the unique check for the 'email' field
                Rule::unique('employees', 'email')->ignore($this->route('employee')), // Skips uniqueness check for the current company's email
            ],
           
            'phone' => 'nullable|string|regex:/^\+?[0-9]{10,15}$/',
        ];
    }
}
