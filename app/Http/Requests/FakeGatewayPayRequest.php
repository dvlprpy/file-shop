<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FakeGatewayPayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // اگر لاگین اجباری بود می‌تونی تغییر بدی
    }

    public function rules(): array
    {
        return [
            'plan_id'         => ['required', 'exists:plans,plan_id'],
            'card_number'     => ['required', 'regex:/^\d{16}$/'], // ۱۶ رقم
            'second_password' => ['required', 'digits_between:4,12'], // رمز دوم بین ۴ تا ۱۲ رقم
            'cvv2'            => ['required', 'regex:/^\d{3,4}$/'], // ۳ یا ۴ رقم
            'expire_date'     => ['required', 'regex:/^(0[1-9]|1[0-2])\/(\d{2}|\d{4})$/'], // MM/YY یا MM/YYYY
        ];
    }

    public function messages(): array
    {
        return [
            'plan_id.required'     => 'شناسه پلن الزامی است.',
            'plan_id.exists'       => 'پلن انتخابی معتبر نیست.',

            'card_number.required' => 'شماره کارت الزامی است.',
            'card_number.regex'    => 'شماره کارت باید دقیقاً ۱۶ رقم باشد.',

            'second_password.required' => 'رمز دوم (پویا) الزامی است.',
            'second_password.digits_between' => 'رمز دوم باید بین ۴ تا ۱۲ رقم باشد.',

            'cvv2.required'        => 'کد CVV2 الزامی است.',
            'cvv2.regex'           => 'کد CVV2 باید ۳ یا ۴ رقم باشد.',

            'expire_date.required' => 'تاریخ انقضا الزامی است.',
            'expire_date.regex'    => 'تاریخ انقضا باید به فرمت MM/YY یا MM/YYYY وارد شود.',
        ];
    }
}
