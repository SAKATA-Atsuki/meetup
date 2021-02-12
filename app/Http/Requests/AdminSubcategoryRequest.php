<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSubcategoryRequest extends FormRequest
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
            'circle_category_id' => 'required',
            'name' => 'required|max:40'
        ];
    }

    public function messages()
    {
        return [
            'circle_category_id.required' => '※選択してください',
            'name.required' => '※入力してください',
            'name.max' => '※40文字以内で入力してください'
        ];
    }
}
