<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules(): array
    {
        return [
            'fullname' => 'required|string|max:100|regex:/^[\p{Arabic}a-zA-Z0-9\s]+$/u',
            'username' => 'required|string|max:50|unique:users|regex:/^[a-zA-Z0-9]+$/',
            'email' => 'required|email|max:200|unique:users',
            'password' => 'required|string|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            'phone' => 'required|digits:11|unique:users|regex:/^09[0-9]{9}$/',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ];
    }
}
