<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => 'required|string|min:3|max:30|unique:teachers,user_name',
            'full_name' => 'required|string|min:3|max:100',
            'email' => 'required|string|email|unique:teachers',
            'password' => 'required|string|confirmed'
        ];
    }
}
