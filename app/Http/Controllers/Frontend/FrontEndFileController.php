<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use App\Utility\SubscriptionChecker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FrontEndFileController extends Controller
{

    /* File Details */
    public function detail(Request $request, $file_id)
    {
        $file = File::find($file_id);
        $user_id = Auth::user()->user_id; /* user id */
        $subscription = SubscriptionChecker::checkUserSubscription($user_id); /* check user subscribe */
        return view('frontend.files.detail', compact('file', 'subscription'));
    }

    /* get File Private Path */
    public function privateThumbnail($id)
    {
        $file = File::findOrFail($id);

        if ($file->visibility !== 'private') {
            abort(404);
        }

        $path = storage_path('app/private/' . $file->path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => mime_content_type($path)
        ]);
    }


    /* File Load More */
    public function loadMore(Request $request)
    {
        $files = File::paginate(10);

        // این خط رو اصلاح کن
        $html = view('frontend.partials.file-cards', compact('files'))->render();

        return response()->json([
            'html' => $html,
            'next_page' => $files->currentPage() < $files->lastPage() ? $files->currentPage() + 1 : null
        ]);
    }


    /* Download File */
    public function download(Request $request, $file_id)
    {
        $file = File::findOrFail($file_id);
        $user = Auth::user()->user_id; 

        // گرفتن آخرین اشتراک کاربر
        $subscription = SubscriptionChecker::checkUserSubscription($user);
        $subscribe = $subscription['subscribe'];

        // چک اشتراک فعال
        if (!$subscription['status']) {
            return redirect()->route('frontend.plan.buy')
                            ->with('error', $subscription['message']);
        }

        // چک سقف دانلود
        if ($subscribe->subscribe_download_count >= $subscribe->subscribe_download_limit) {
            return redirect()->route('frontend.plan.buy')
                            ->with('error', 'سقف دانلود شما به پایان رسیده است.');
        }

        // چک تاریخ انقضا
        if (now()->gt($subscribe->subscribe_expired_at)) {
            return redirect()->route('frontend.plan.buy')
                            ->with('error', 'اشتراک شما منقضی شده است.');
        }

        // ✅ افزایش شمارنده دانلود بدون تغییر تاریخ‌ها
        $subscribe->subscribe_download_count++;
        $subscribe->save(['timestamps' => false]);

        // دانلود فایل بر اساس visibility
        switch ($file->visibility) {
            case 'public':
                return Storage::disk('public')->download($file->path, $file->file_original_name);

            case 'private':
                $fullpath = storage_path('app/private/' . str_replace('/', DIRECTORY_SEPARATOR, $file->path));
                return response()->download($fullpath, $file->file_original_name);

            default:
                abort(403, 'نوع فایل نامشخص است.');
        }
    }


}