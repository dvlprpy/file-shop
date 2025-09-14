<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DownloadStatsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // --- ۱. داده روزانه (15 روز گذشته) ---
        $dailyLabels = [];
        $dailyFileData = [];
        $dailyPackageData = [];

        for ($i = 15; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dailyLabels[] = $date;

            $dailyFileData[] = Download::whereDate('created_at', $date)
                ->where('downloadable_type', 'App\Models\File')->count();

            $dailyPackageData[] = Download::whereDate('created_at', $date)
                ->where('downloadable_type', 'App\Models\Package')->count();
        }

        return view('admin.dashboard.index', compact(
            'dailyLabels','dailyFileData','dailyPackageData','user'
        ));
    }
}
