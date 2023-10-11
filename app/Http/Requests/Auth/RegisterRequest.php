<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:55',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:5|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Thiếu tên rồi nhé',
            'name.max' => 'Tên quá dài rồi',
            'email.unique' => ' Tên đã tồn tại rồi',
            'password.confirmed' => 'Phải có trường xác nhận mật khẩu và nó phải trùng với mật khẩu',
        ];
    }
}
