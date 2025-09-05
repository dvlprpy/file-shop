<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class FrontEndFileController extends Controller
{
    public function detail(Request $request, $file_id)
    {
        $file = File::find($file_id);
        return view('frontend.files.detail', compact('file'));
    }

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


}
