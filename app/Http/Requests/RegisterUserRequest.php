<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6|max:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bắt buộc nhập tên',
            'name.min' => 'Tên tối thiểu 3 kí tự',
            'email.required' => 'Bắt buộc nhập email',
            'email.email' => 'Email sai định dạng',
            'email.unique' => 'Email phải duy nhất',
            'password.required' => 'Bắt buộc nhập password',
            'password.min' => 'Password ít nhất 6 kí tự',
            'password.max' => 'Password tối đa 10 kí tự',
            'password.confirmed' => 'Password, password confirm phải giống nhau',
        ];
    }
}
