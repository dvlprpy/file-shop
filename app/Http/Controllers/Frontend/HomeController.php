<?php

namespace App\Http\Controllers\Frontend;

use App\Models\File;
use App\Models\Package;
use Illuminate\Http\Request;

class HomeController
{
    public function index()
    {
        $file = File::all();
        $package = Package::all();
        return view('frontend.index', compact('file', 'package'));
    }
}
