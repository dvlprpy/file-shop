<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSelectedUserPackage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'packages'   => 'required|array',
            'packages.*' => 'exists:packages,package_id',
        ];
    }

    public function messages(): array
    {
        return [
            'packages.required' => 'حداقل یک پکیج باید انتخاب شود.',
            'packages.array'    => 'اطلاعات ارسالی معتبر نیست.',
            'packages.*.exists' => 'پکیج انتخاب شده معتبر نیست.',
        ];
    }
}
