<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Category;
use App\Models\File;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // بارگذاری پکیج‌ها به همراه دسته‌بندی‌ها
        $data = Package::with('categories')->get();

        return view('admin.package.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $package = new Package(); // نمونه خالی
        $selectedPackages = [];
        return view('admin.package.create', compact('category', 'package', 'selectedPackages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request)
    {
        $validated = $request->validated();
        $package = Package::create([
            'package_title' => $validated['package_title'], 
            'package_description' => $validated['package_description'],
            'package_price' => $validated['package_price'],
        ]);

        $categories = array_filter((array) $validated['package_category'], fn($id) => $id != 0);
        $package->categories()->sync($categories);
        
        return redirect()->route('package.index')->with('success', 'پکیج مورد نظر با موفقیت ایجاد شد. ');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        $selectedPackages = $package->categories->pluck('category_id')->toArray();
        $category = Category::all();
        return view('admin.package.edit', compact('selectedPackages','category', 'package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $request, string $id)
    {
        $package = Package::where('package_id', $id)->firstOrFail();
        $validated = $request->validated();

        // بروزرسانی مقادیر خود مدل
        $package->update([
            "package_title" => $validated['package_title'],
            "package_description" => $validated['package_description'],
            "package_price" => $validated['package_price'],
        ]);

        // حذف گزینه 0 (بدون دسته‌بندی) و sync دسته‌بندی‌ها
        $categories = array_filter((array) $validated['package_category'], fn($id) => $id != 0);
        $package->categories()->sync($categories);

        return redirect()->route('package.index')->with('success', 'پکیج مورد نظر با موفقیت بروز رسانی شد.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package_record = Package::where('package_id', $id)->firstOrFail();

        $package_record->delete();

        return redirect()->route('package.index')->with('success', 'پکیج مورد نظر با موفقیت حذف گردید.');
    }

    /**
     * Many to Many Relation Between 'Package' & 'File' Tables.
     */
    public function editSyncFile($package_id)
    {
        $package = Package::where('package_id', $package_id)->firstOrFail();

        $files = File::all();

        return view('admin.package.syncFiles', compact('package', 'files'));
    }

    public function updateSyncFile(Request $request, $package_id)
    {
        $package = Package::where('package_id', $package_id)->firstOrFail();

        $validated = $request->validate([
            'file_ids' => 'nullable|array',
            'file_ids.*' => 'exists:files,file_id',
        ]);

        $fileIds = $validated['file_ids'] ?? [];

        // sync فایل‌ها با پکیج
        $package->files()->sync($fileIds);

        return redirect()->route('package.index')->with('success', 'فایل‌های مرتبط با پکیج با موفقیت بروزرسانی شدند.');
    }

}