<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Hankaku;

class FreshmanRegisterRequest extends FormRequest
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
            'campus_id' => 'required',
            'email' => 'required|max:200|email|unique:freshmen',
            'password' => ['required', 'min:8', 'max:20', new Hankaku],
            'password_check' => ['required', 'min:8', 'max:20', new Hankaku, 'same:password']
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
            'campus_id.required' => '※選択してください',
            'email.required' => '※入力してください',
            'email.max' => "※200文字以内で入力してください",
            'email.email' => '※正しい形式で入力してください',
            'email.unique' => '※このメールアドレスは既に登録されています',
            'password.required' => '※入力してください',
            'password.min' => '※8〜20文字で入力してください',
            'password.max' => '※8〜20文字で入力してください',
            'password_check.required' => '※入力してください',
            'password_check.min' => '※8〜20文字で入力してください',
            'password_check.max' => '※8〜20文字で入力してください',
            'password_check.same' => '※「パスワード」と一致しません'
        ];
    }
}
