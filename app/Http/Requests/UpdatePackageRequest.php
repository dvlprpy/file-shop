<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // اگر نیاز دارید احراز هویت اضافه کنید، اینجا شرط بگذارید
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // گرفتن id پکیج برای unique کردن title هنگام آپدیت
        $packageId = $this->route('package'); 

        return [
            'package_title' => 'required|string|max:220|unique:packages,package_title,' . $packageId . ',package_id',
            'package_description' => 'nullable|string',
            'package_price' => 'required|numeric|min:0',
            'package_category' => 'required|array',
            'package_category.*' => 'integer|exists:categories,category_id',

        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'package_title.required' => 'وارد کردن عنوان پکیج الزامی است.',
            'package_title.string'   => 'عنوان پکیج باید متن باشد.',
            'package_title.max'      => 'عنوان پکیج نمی‌تواند بیش از ۲۲۰ کاراکتر باشد.',
            'package_title.unique'   => 'این عنوان پکیج قبلا ثبت شده است.',
            'package_price.required' => 'وارد کردن قیمت پکیج الزامی است.',
            'package_price.numeric'  => 'قیمت پکیج باید عدد باشد.',
            'package_price.min'      => 'قیمت پکیج نمی‌تواند منفی باشد.',
            'package_category.required' => 'انتخاب دسته‌بندی پکیج الزامی است.',
            'package_category.integer'  => 'شناسه دسته‌بندی باید عدد صحیح باشد.',
            'package_category.exists'   => 'دسته‌بندی انتخاب شده معتبر نیست.',
        ];
    }
}
