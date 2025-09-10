<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use App\Utility\SubscriptionChecker;

class FrontEndPackageController extends Controller
{
    /* show Pakcage Details */
    public function detail(Request $request, $package_id)
    {
        $package = Package::find($package_id);
        $userId = 5; /* Pass Fack User id  */
        $subscription = SubscriptionChecker::checkUserSubscription($userId); /* Check User Subscribe */
        return view('frontend.files.detail' , compact('package', 'subscription'));
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
        // 
    }
}
