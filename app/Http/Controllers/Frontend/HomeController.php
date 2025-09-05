<?php

namespace App\Http\Controllers\Frontend;

use App\Models\File;
use App\Models\Package;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        $files = File::paginate(10);       // 10 فایل در هر صفحه
        $packages = Package::paginate(10); // 10 پکیج در هر صفحه
        return view('frontend.index', compact('files', 'packages'));
    }
}
