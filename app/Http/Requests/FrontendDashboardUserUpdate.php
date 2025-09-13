<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FrontendDashboardUserUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = Auth::user()->user_id;

        return [
            'fullname' => ['required', 'string', 'max:100', 'regex:/^[\p{Arabic}a-zA-Z0-9\s]+$/u'],
            'username' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9]+$/', 'unique:users,username,' . $userId . ',user_id'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email,' . $userId . ',user_id'],
            'phone'    => ['nullable', 'string', 'regex:/^09[0-9]{9}$/', 'unique:users,phone,' . $userId . ',user_id'],
            'password' => ['nullable', 'min:8', 'max:15', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).+$/'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'نام و نام خانوادگی الزامی است.',
            'username.required' => 'نام کاربری الزامی است.',
            'username.unique'   => 'این نام کاربری قبلاً استفاده شده است.',
            'email.required'    => 'ایمیل الزامی است.',
            'email.unique'      => 'این ایمیل قبلاً ثبت شده است.',
            'phone.unique'      => 'این شماره تماس قبلاً استفاده شده است.',
            'password.min'      => 'رمز عبور باید حداقل ۶ کاراکتر باشد.',
            'profile_picture.image' => 'فایل انتخاب شده باید تصویر باشد.',
            'profile_picture.mimes' => 'فرمت تصویر باید jpg, jpeg, png یا webp باشد.',
            'profile_picture.max'   => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
        ];
    }
}
