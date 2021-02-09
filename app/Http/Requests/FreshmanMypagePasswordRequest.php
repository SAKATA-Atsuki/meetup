<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Hankaku;

class FreshmanMypagePasswordRequest extends FormRequest
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
            'password' => ['required', 'min:8', 'max:20', new Hankaku],
            'password_check' => ['required', 'min:8', 'max:20', new Hankaku, 'same:password']
        ];
    }

    public function messages()
    {
        return [
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
