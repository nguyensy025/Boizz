<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name' => 'bail|required|unique:products|max:255|min:10',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'contents' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Chưa nhập tên SP',
            'name.unique' => 'Tên không thể trùng',
            'name.max' => 'Tên không thể dài hơn 255 kí tự',
            'name.min' => 'Tên không thể dưới 10 kí tự',
            'price.required' => 'Chưa nhập giá SP',
            'price.numeric' => 'Giá trị không hợp lệ',
            'category_id.required' => 'Chưa chọn danh mục SP',
            'contents.required' => 'Chưa nhập mô tả SP',
        ];
    }
}
