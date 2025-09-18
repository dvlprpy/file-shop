<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use App\Utility\SubscriptionChecker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class FrontEndPackageController extends Controller
{
    /* show Pakcage Details */
    public function detail(Request $request, $package_id)
    {
        $package = Package::find($package_id);
        $userId = Auth::user()->user_id; /* Pass Fack User id  */
        $package_file_list = Package::find($package_id)->files;

        $subscription = SubscriptionChecker::checkUserSubscription($userId); /* Check User Subscribe */
        return view('frontend.files.detail' , compact('package', 'subscription', 'package_file_list'));
    }


    /* Package LoadMore */
    public function loadMore(Request $request)
    {
        $packages = Package::paginate(10);

        $html = view('frontend.partials.package-cards', compact('packages'))->render();

        return response()->json([
            'html' => $html,
            'next_page' => $packages->currentPage() < $packages->lastPage() ? $packages->currentPage() + 1 : null
        ]);
    }



    /* Package Download */
    public function download(Request $request, $package_id)
    {
        $package = Package::with('files')->findOrFail($package_id);

        // فایل‌های انتخاب شده از فرم
        $fileIds = $request->input('files', []);

        if (empty($fileIds)) {
            return redirect()->back()->with('error', 'هیچ فایلی برای دانلود انتخاب نشده است.');
        }

        $files = $package->files()->whereIn('files.file_id', $fileIds)->get();

        if ($files->isEmpty()) {
            return redirect()->back()->with('error', 'فایل‌های انتخاب شده موجود نیستند.');
        }

        // نام فایل ZIP
        $zipFileName = 'package_' . $package->package_id . '.zip';
        $zipPath = storage_path('app/public/' . $zipFileName);

        // حذف ZIP قبلی اگر وجود داشت
        if (file_exists($zipPath)) {
            unlink($zipPath);
        }

        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {

            foreach ($files as $file) {
                if ($file->visibility === 'public') {
                    $filePath = storage_path('app/public/' . $file->path);
                } else {
                    $filePath = storage_path('app/private/' . $file->path);
                }

                if (file_exists($filePath)) {
                    // نام فایل داخل ZIP همان نام اصلی
                    $zip->addFile($filePath, basename($file->path));
                }
            }

            $zip->close();
        } else {
            return redirect()->back()->with('error', 'خطا در ساخت فایل ZIP.');
        }

        // برگرداندن فایل ZIP برای دانلود
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    public function preview($file_id)
    {
       $file = File::findOrFail($file_id);

        $path = $file->path;

        if ($file->visibility !== 'private') {
            abort(404);
        }

        if (!Storage::disk('private')->exists($path)) {
            abort(404);
        }

        $mime = Storage::disk('private')->mimeType($path);
        $content = Storage::disk('private')->get($path);

        return response($content, 200)->header('Content-Type', $mime);
    }
}
