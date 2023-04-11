<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonnelRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'employee_number' => 'sometimes|required|string',
            'name' => 'sometimes|required|string',
            'position' => 'sometimes|required|string',
            'department_name' => 'string',
            'campus' => 'string',
            'contact_no' => 'string',
            'email' => 'email|regex:/(.*)@bulsu\.edu\.ph/i',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'isActive' => 'boolean'
        ];
        
    }
}
