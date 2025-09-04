<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();

        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $createCategory = Category::create($request->validated());
        
        if ($createCategory) {
            return redirect()->route('category.index')->with('success', 'دسته بندی مورد نظر با موفقیت ثبت شد.');
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoryEdit = Category::where('category_id', $id)->firstOrFail();
        return view('admin.category.edit', compact('categoryEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $category = Category::where('category_id', $id)->firstOrFail();
        $categoryResult = $category->update($request->validated());
        if ($categoryResult) {
            return redirect()->route('category.index')->with('success', 'دسته بندی مورد نظر با موفقیت ویرایش شد.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('category_id', $id)->firstOrFail();
        $categoryResult = $category->delete($category);
        if ($categoryResult) {
            return redirect()->route('category.index')->with('success', 'دسته بندی مورد نظر با موفقیت حذف شد.');
        }
    }
}
