<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('frontend.userAuth.register')->with('pageTitle', 'صفحه ثبت نام');
    }

    public function register(RegisterRequest $request)
    {
        
        // ذخیره تصویر پروفایل در صورت وجود
        if ($request->hasFile('profile_picture')) {
            $extension = strtolower($request->file('profile_picture')->getClientOriginalExtension());

            // تولید نام با تاریخ + شناسه یکتا
            $fileName = now()->format('Y-m-d_H-i-s') . '_' . uniqid('profile_', true) . '.' . $extension;

            // ذخیره در مسیر public/profile_pictures
            $path = $request->file('profile_picture')->storeAs('profile_pictures', $fileName, 'public');

            $request['profile_picture'] = $path;
        } else {
            // اگر کاربر عکسی نداد → پیش‌فرض بذار
            $request['profile_picture'] = 'images/default-avatar.svg';
        }


        $user_result = User::create([
            'fullname' => $request['fullname'], 
            'username' => $request['username'], 
            'password' => $request['password'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'profile_picture' => $request['profile_picture'],
        ]);

        if ($user_result && $user_result instanceof User) {
            Auth::login($user_result);
            return redirect()->route('home');
        }
        return redirect()->back()->with('registerError', 'در فرایند ثبت نام شما مشکلی پیش آمده است لطفا دوباره تلاش کنید.');
    }
}
