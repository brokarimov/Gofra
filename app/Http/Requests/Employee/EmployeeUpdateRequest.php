<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'tel' => 'required|max:255',
            'salary_type' => 'exists:salaries,id',
            'department_id' => 'exists:departments,id',
            'start_day' => 'nullable|date_format:H:i',
            'end_day' => 'nullable|date_format:H:i',
        ];
    }
}
