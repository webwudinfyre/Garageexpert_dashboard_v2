<?php

namespace App\Http\Requests\Admin;


use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class clientuserupdate extends FormRequest
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
            'First_Name' => ['required','max:255'],
           'Last_Name' => ['required','max:255'],
           'Email'=>['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
           'Phone_number' => ['required','numeric'],
           'Password' => ['required', Rules\Password::defaults()],

        //    'officedetails.*.Sub_Office_Name' =>['required','max:255'],
        //     'officedetails.*.Location' => ['required','max:255'],
        //     'officedetails.*.email_office' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
        //     'officedetails.*.password_office' =>['required', Rules\Password::defaults()],
        ];
    }
}
