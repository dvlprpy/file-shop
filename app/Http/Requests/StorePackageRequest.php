<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'package_title' => 'required|string|max:220',
            'package_description' => 'required|string',
            'package_price' => 'required|integer|min:0',
            'package_category' => 'required|array',
            'package_category' => 'required|exists:categories,category_id',
        ];
    }

    public function messages(): array
    {
        return [
            'package_title.required' => 'وارد کردن عنوان پکیج الزامی است.',
            'package_title.string' => 'عنوان پکیج باید متن باشد.',
            'package_title.max' => 'عنوان پکیج نمی‌تواند بیش از ۲۲۰ کاراکتر باشد.',
            'package_description.required' => 'وارد کردن توضیحات پکیج الزامی است.',
            'package_description.string' => 'توضیحات پکیج باید متن باشد.',
            'package_price.required' => 'وارد کردن قیمت پکیج الزامی است.',
            'package_price.integer' => 'قیمت پکیج باید یک عدد صحیح باشد.',
            'package_price.min' => 'قیمت پکیج نمی‌تواند منفی باشد.',
            'package_category.required' => 'انتخاب دسته‌بندی پکیج الزامی است.',
            'package_category.exists' => 'دسته‌بندی انتخاب شده معتبر نیست.',
        ];
    }
}
