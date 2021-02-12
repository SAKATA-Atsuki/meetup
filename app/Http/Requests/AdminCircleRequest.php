<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Hankaku;
use Illuminate\Validation\Rule;

class AdminCircleRequest extends FormRequest
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
        if ($this->password == '' && $this->password_check == '') {
            return [
                'name' => 'required|max:40',
                'campus_id' => 'required',
                'circle_category_id' => 'required',
                'circle_subcategory_id' => 'required',
                'email' => ['required', 'max:200', 'email', Rule::unique('circles')->ignore($this->id)],
            ];    
        } else {
            return [
                'name' => 'required|max:40',
                'campus_id' => 'required',
                'circle_category_id' => 'required',
                'circle_subcategory_id' => 'required',
                'email' => ['required', 'max:200', 'email', Rule::unique('circles')->ignore($this->id)],
                'password' => ['required', 'min:8', 'max:20', new Hankaku],
                'password_check' => ['required', 'min:8', 'max:20', new Hankaku, 'same:password']
            ];    
        }
    }

    public function messages()
    {
        return [
            'name.required' => '※入力してください',
            'name.max' => '※40文字以内で入力してください',
            'campus_id.required' => '※選択してください',
            'circle_category_id.required' => '※選択してください',
            'circle_subcategory_id.required' => '※選択してください',
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
