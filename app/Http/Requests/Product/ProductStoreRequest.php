<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => "required|max:100|unique:products,name",
            'price' => "nullable",
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Tên truyền là bắt buộc",
            'name.max' => "Tên quá dài",
            'name.unique' => "Tên đã có rồi nhé",
        ];
    }
}
