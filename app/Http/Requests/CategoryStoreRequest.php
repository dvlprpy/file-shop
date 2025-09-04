<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_name' => 'required|string|max:255|unique:categories,category_name',
        ];
    }

    public function messages(): array
    {
        return [
            'category_name.required' => 'وارد کردن عنوان دسته بندی الزامی است.',
            'category_name.string'   => 'عنوان دسته بندی باید متن باشد.',
            'category_name.max'      => 'عنوان دسته بندی نمی‌تواند بیش از ۲۵۵ کاراکتر باشد.',
            'category_name.unique'   => 'این عنوان دسته بندی قبلا ثبت شده است.',
        ];
    }
}
