<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\File;
use App\Models\Package;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class HomeController
{
    public function index()
    {
        $files = File::paginate(10);       // 10 فایل در هر صفحه
        $packages = Package::paginate(10); // 10 پکیج در هر صفحه
        $category = Category::all(); 
        $popular_file = File::popular()->get()->take(5);
        return view('frontend.index', compact('files', 'packages', 'category', 'popular_file'));
    }


    /* Buy Plan */
    public function planBuy()
    {
        $plans = Plan::all();
        return view('frontend.plan.buy', compact('plans'));
    }



    /* Purchase Plan */
    public function purchase($plan_id)
    {
        $plan_purch = Plan::find($plan_id);
        $jalali_date_now = Jalalian::fromCarbon(Carbon::now());
        $jalali_date_next = Jalalian::fromCarbon(Carbon::now())->addDays($plan_purch->plan_day);
        return view('frontend.plan.purchase_plan', compact('plan_purch','jalali_date_now', 'jalali_date_next'));
    }


    /* About Us Page */
    public function about()
    {
        return view('frontend.partials.about');
    }
}