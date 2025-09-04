<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $data = File::all(); */
        $data = File::with('categories')->get();
        return view('admin.file.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // حتما اسمش categories باشه تا با view هماهنگ باشه
        $file = new File();
        $selectedCategories = []; // چون فایل جدیده، هیچ دسته‌ای انتخاب نشده

        return view('admin.file.create', compact('file', 'categories', 'selectedCategories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(FileRequest $request)
    {
        $validated = $request->validated();

        $uploaded = $request->file('your_file');
        $fileHash = (string) Str::uuid();
        $extension = $uploaded->getClientOriginalExtension();
        $fileName = $fileHash . '.' . $extension;

        // انتخاب disk بر اساس visibility
        $disk = $validated['visibility'] === 'public' ? 'public' : 'private';
        $path = $uploaded->storeAs('uploads', $fileName, $disk);

        $file = File::create([
            'file_title' => $validated['file_title'],
            'file_description' => $validated['file_description'],
            'file_original_name' => $uploaded->getClientOriginalName(),
            'file_type' => $uploaded->getMimeType(),
            'file_size' => $uploaded->getSize(),
            'file_hash' => $fileHash,
            'path' => $path,
            'visibility' => $validated['visibility'],
        ]);

        $file->categories()->sync($validated['file_category']);

        return redirect()->route('file.index')->with('success', 'فایل با موفقیت ذخیره شد.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        $categories = Category::all();  // همه دسته‌ها
        $selectedCategories = $file->categories->pluck('category_id')->toArray(); // دسته‌های انتخاب‌شده
        
        return view('admin.file.edit', compact('file', 'categories', 'selectedCategories'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        $validated = $request->validated();

        // اگر فایل جدید آپلود شده
        if ($request->hasFile('your_file')) {
            $uploaded  = $request->file('your_file');
            $fileHash  = (string) Str::uuid();
            $extension = $uploaded->getClientOriginalExtension();
            $fileName  = $fileHash . '.' . $extension;
            $disk      = $validated['visibility'] === 'public' ? 'public' : 'private';
            $path      = $uploaded->storeAs('uploads', $fileName, $disk);

            // حذف فایل قبلی در صورت وجود
            if ($file->path && Storage::disk($file->visibility)->exists($file->path)) {
                Storage::disk($file->visibility)->delete($file->path);
            }

            $file->update([
                'file_title'        => $validated['file_title'],
                'file_description'  => $validated['file_description'],
                'file_original_name'=> $uploaded->getClientOriginalName(),
                'file_type'         => $uploaded->getMimeType(),
                'file_size'         => $uploaded->getSize(),
                'file_hash'         => $fileHash,
                'path'              => $path,
                'visibility'        => $validated['visibility'],
            ]);

        } else {
            // اگر فقط visibility تغییر کرده
            if ($file->visibility !== $validated['visibility']) {
                $oldDisk = $file->visibility;
                $newDisk = $validated['visibility'];

                if ($file->path && Storage::disk($oldDisk)->exists($file->path)) {
                    $content = Storage::disk($oldDisk)->get($file->path);
                    Storage::disk($newDisk)->put($file->path, $content);
                    Storage::disk($oldDisk)->delete($file->path);
                }

                $file->visibility = $newDisk;
            }

            $file->update([
                'file_title'       => $validated['file_title'],
                'file_description' => $validated['file_description'],
                'visibility'       => $file->visibility,
            ]);
        }

        // بروزرسانی دسته‌بندی‌ها
        $file->categories()->sync($validated['file_category']);

        return redirect()
            ->route('file.index')
            ->with('success', 'فایل با موفقیت به‌روزرسانی شد.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {

        Storage::delete($file->path);

        $file->delete();

        return redirect()->route('file.index')->with('success', 'فایل مورد نظر با موفقیت حذف شد.');
    }

    
    /**
     * Download File.
     */
    public function download(File $file)
    {
        $disk = $file->visibility === 'public' ? 'public' : 'private';

        if (!Storage::disk($disk)->exists($file->path)) {
            abort(404, 'فایل مورد نظر یافت نشد.');
        }

        if ($disk === 'public') {
            // برای فایل‌های public، می‌تونیم مستقیم لینک دانلود بدیم
            return Storage::disk('public')->download($file->path, $file->file_original_name);
        } else {
            // برای فایل‌های private، فقط از طریق کنترلر دانلود بشه
            $fullpath = storage_path('app/private/' . str_replace('/', DIRECTORY_SEPARATOR, $file->path));
            return response()->download($fullpath, $file->file_original_name);
        }
    }



    /* 
    * View File 
    */
    public function view(File $file)
    {
        $fullpath = storage_path('app/private/' . str_replace('/', DIRECTORY_SEPARATOR, $file->path));
        $fullpath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR , $fullpath);
        if (!file_exists($fullpath)) {
            abort(404, 'فایل مورد نظر یافت نشد.');
        }
        return view('admin.file.view', compact('file'));
    }

    public function accessFile(File $file)
    {
        $disk = $file->visibility === 'public' ? 'public' : 'private';
        if (!Storage::disk($disk)->exists($file->path)) {
            abort(404, 'فایل مورد نظر یافت نشد.');
        }

        // برای فایل‌های public می‌تونیم url بدیم، برای private باید response()->file یا download
        if ($disk === 'public') {
            return redirect(Storage::disk('public')->url($file->path));
        } else {
            $fullpath = storage_path('app/private/' . str_replace('/', DIRECTORY_SEPARATOR, $file->path));
            return response()->file($fullpath);
        }
    }
}