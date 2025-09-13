<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontendDashboardUserUpdate;
use App\Models\Plan;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /* Show User Dashboard */
    public function Dashboard()
    {
        $user = Auth::user();
        return view('frontend.dashboard.index', compact('user'));
    }


    /* Show User Info */
    public function Info()
    {
        $user = Auth::user();
        return view('frontend.dashboard.info', compact('user'));
    }


    /* Edit User Info */
    public function Edit()
    {
        $user = Auth::user();
        return view('frontend.dashboard.form', compact('user'));
    }


    /* Update User Info */
    public function Update(FrontendDashboardUserUpdate $request)
    {
        $user = Auth::user();

        $validated = $request->validated();

        // هش کردن پسورد اگر وارد شده
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        // تصویر پروفایل
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $extension = $file->getClientOriginalExtension();
            $baseFolder = 'dashboard/' . $user->email;

            // نام فایل با زمان و یکتایی
            $filename = $user->username . '-' . now()->format('Y-m-d_H-i-s') . '_' . uniqid('profile_', true) . '.' . $extension;

            // آپلود فایل در storage/app/public/dashboard/{email}/
            $path = $file->storeAs($baseFolder, $filename, 'public');

            // حذف تصویر قبلی در صورت وجود
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // مسیر جدید رو در validated قرار بده تا آپدیت بشه
            $validated['profile_picture'] = $path;
        }

        // آپدیت کاربر
        $user->update($validated);

        return redirect()->route('frontend.user.dashboard.show')->with('success', 'اطلاعات با موفقیت به‌روزرسانی شد ✅');
    }


    /* Show User Purchase Plans */
    public function Plan()
    {
        /* 
        subscribe_download_limit
        subscribe_download_count
        subscribe_created_at
        subscribe_expired_at
        */
        // Step 1: Get User Id
        $user_id = Auth::id();

        /* $subscribePlan = Subscribe::where('subscribe_user_id', $user_id)
            ->get(); 

        // Step 2: Get subscribed plan ids
        $subscribePlanIds = Subscribe::where('subscribe_user_id', $user_id)
            ->pluck('subscribe_plan_id'); 

        // Step 3: Get plans by these ids
        $plans = Plan::whereIn('plan_id', $subscribePlanIds)->get(); */

        $subscribe = Subscribe::with('plan')->where('subscribe_user_id', $user_id)->get();

        $user = Auth::user();

        return view('frontend.dashboard.plan', compact('subscribe', 'user'));
    }
}