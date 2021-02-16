<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreshmanMypageEmailRequest extends FormRequest
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
            'email' => 'required|max:200|email|unique:freshmen|ends_with:ed.ritsumei.ac.jp'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '※入力してください',
            'email.max' => "※200文字以内で入力してください",
            'email.email' => '※正しい形式で入力してください',
            'email.unique' => '※このメールアドレスは既に登録されています',
            'email.ends_with' => '※立命館大学から発行されたメールアドレスを入力してください'
        ];
    }
}
