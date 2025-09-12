<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'remember' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'وارد کردن ایمیل الزامی است.',
            'email.email'    => 'لطفاً یک آدرس ایمیل معتبر وارد کنید.',
            
            'password.required' => 'وارد کردن رمز عبور الزامی است.',
            'password.string'   => 'رمز عبور باید شامل کاراکترهای معتبر باشد.',
            'password.min'      => 'رمز عبور باید حداقل :min کاراکتر باشد.',

            'remember.boolean' => 'مقدار فیلد مرا به خاطر بسپار معتبر نیست.',
        ];
    }
}