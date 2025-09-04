<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Plan::all();
        return view('admin.plan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan_title' => 'required|string|max:200',
            'plan_download_limit' => 'required|integer|min:1',
            'plan_price' => 'required|numeric|min:1',
            'plan_day' => 'required|integer|min:1',
        ]);

        \App\Models\Plan::create([
            'plan_title' => $request['plan_title'],
            'plan_download_limit' => $request['plan_download_limit'],
            'plan_price' => $request['plan_price'],
            'plan_day' => $request['plan_day'],
        ]);

        return redirect()->route('plan.index')->with('success', 'طرح مورد نظر با موفقیت ثبت شد.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $get_plan = Plan::where('plan_uuid', $id)->firstOrFail();
        
        return view('admin.plan.edit', compact('get_plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $plan)
    {
        $request->validate([
            'plan_title' => ' nullable|string|max:200',
            'plan_download_limit' => 'nullable|integer|min:1',
            'plan_price' => 'nullable|numeric|min:1',
            'plan_day' => 'nullable|integer|min:1',
        ]);

        $plan_record = Plan::where('plan_uuid', $plan)->firstOrFail();

        $plan_record->update($request->only([
            'plan_title',
            'plan_download_limit',
            'plan_price',
            'plan_day',
        ]));

        return redirect()->route('plan.index')->with('success', 'طرح مورد نظر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan_record = Plan::where('plan_uuid', $id)->firstOrFail();

        $plan_record->delete();

        return redirect()->route('plan.index')->with('success','طرح مورد نظر با موفقیت حذف  گردید.');
    }
}
