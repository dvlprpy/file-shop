<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('category'); // id دسته‌بندی از route
        return [
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $categoryId . ',category_id',
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

