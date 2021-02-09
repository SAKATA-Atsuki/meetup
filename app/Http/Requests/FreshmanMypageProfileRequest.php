<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreshmanMypageProfileRequest extends FormRequest
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
            'name_sei' => 'required|max:20',
            'name_mei' => 'required|max:20',
            'nickname' => 'required|max:10',
            'gender' => 'required',
            'campus_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name_sei.required' => '※氏名（姓）を入力してください',
            'name_sei.max' => '※氏名（姓）は20文字以内で入力してください',
            'name_mei.required' => '※氏名（名）を入力してください',
            'name_mei.max' => '※氏名（名）は20文字以内で入力してください',
            'nickname.required' => '※入力してください',
            'nickname.max' => '※10文字以内で入力してください',
            'gender.required' => '※選択してください',
            'campus_id.required' => '※選択してください'
        ];
    }
}
