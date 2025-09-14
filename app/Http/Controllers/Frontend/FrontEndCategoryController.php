<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontEndCategoryController extends Controller
{
    /* Details of category */
    public function detail(Request $request, $category_id)
    {
        $category_item = Category::find($category_id);
        $file = $category_item->files;
        $package = $category_item->packages;
        return view('frontend.category.detail', compact('category_item', 'file', 'package'));
    }
}
