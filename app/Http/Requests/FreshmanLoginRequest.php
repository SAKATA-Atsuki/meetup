<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreshmanLoginRequest extends FormRequest
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
            'email' => 'required|exists:freshmen',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '※入力してください',
            'email.exists' => '※このメールアドレスは登録されていません',
            'password.required' => '※入力してください'
        ];
    }
}
