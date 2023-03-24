<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailValidation;

class StoreUserRequest extends FormRequest
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
            
                'employee_number' => 'required|string|max:200|unique:users',
                'name' => 'required|string|max:255',
                'email' => ['required','string','email','max:255','unique:users', 'regex:/(.*)@bulsu\.edu\.ph/i'],
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
                'role'=>'required|string|max:255'

        ];
    }
}
