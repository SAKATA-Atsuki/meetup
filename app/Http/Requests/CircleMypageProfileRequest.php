<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CircleMypageProfileRequest extends FormRequest
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
            'name' => 'required|max:40',
            'campus_id' => 'required',
            'circle_category_id' => 'required',
            'circle_subcategory_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '※入力してください',
            'name.max' => '※40文字以内で入力してください',
            'campus_id.required' => '※選択してください',
            'circle_category_id.required' => '※選択してください',
            'circle_subcategory_id.required' => '※選択してください'
        ];
    }
}
