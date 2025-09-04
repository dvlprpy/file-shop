<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    /**
     * آیا کاربر اجازه استفاده از این Request را دارد؟
     */
    public function authorize(): bool
    {
        return true; // اگه فقط ادمین‌ها دسترسی دارن، می‌تونی اینجا شرط بذاری
    }

    /**
     * قوانین ولیدیشن.
     */
    public function rules(): array
    {
        return [
            'file_title'       => 'required|string|max:255',
            'file_description' => 'required|string',
            'file_category'    => 'required|array',
            'file_category.*'  => 'integer|exists:categories,category_id',
            'your_file'        => 'required|file|mimes:jpg,png,pdf,docx|max:10240',
            'visibility'       => 'required|in:private,public',
        ];
    }

    /**
     * پیام‌های خطا (اختیاری).
     */
    public function messages(): array
    {
        return [
            'file_title.required'       => 'عنوان فایل الزامی است.',
            'file_description.required' => 'توضیحات فایل الزامی است.',
            'file_category.required'    => 'انتخاب حداقل یک دسته‌بندی الزامی است.',
            'file_category.array'       => 'دسته‌بندی باید به صورت آرایه ارسال شود.',
            'file_category.*.exists'    => 'دسته‌بندی انتخاب‌شده معتبر نیست.',
            'your_file.required'        => 'آپلود فایل الزامی است.',
            'your_file.mimes'           => 'فرمت فایل باید jpg, png, pdf یا docx باشد.',
            'your_file.max'             => 'حجم فایل نباید بیشتر از ۱۰ مگابایت باشد.',
            'visibility.in'             => 'وضعیت فایل باید عمومی یا خصوصی باشد.',
        ];
    }
}
