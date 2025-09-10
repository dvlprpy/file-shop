<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FakeGatewayPayRequest;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class FakeGatewayController extends Controller
{
    // نمایش فرم درگاه
    public function show($plan_id)
    {
        $plan = Plan::find($plan_id);
        return view('frontend.gateway.fake', compact('plan'));
    }

    // شبیه‌سازی پرداخت
    public function pay(FakeGatewayPayRequest $request)
    {
        $data = $request->validated();

        // دریافت پلن از دیتابیس
        $plan = Plan::findOrFail($data['plan_id']);

        // دریافت کاربر (در صورت لاگین نکردن، شبیه‌سازی)
        $userId = auth()->id() ?? rand(1, 12);

        // تولید شماره تراکنش و رفرنس
        $ref = strtoupper(Str::uuid()->toString());
        $res = Carbon::now()->format('YmdHis') . rand(10000, 99999);

        // اجرای عملیات در تراکنش برای حفظ امنیت داده
        \DB::transaction(function() use ($userId, $plan, $res, $ref) {

            // ذخیره تراکنش پرداخت
            $payment = Payment::create([
                'payment_user_id' => $userId,
                'payment_method'  => 'card',
                'payment_amount'  => $plan->plan_price,
                'payment_bank_name'=> 'Fake Bank',
                'payment_res_num' => $res,
                'payment_ref_num' => $ref,
                'payment_status'  => 'complete',
            ]);

            // ذخیره اشتراک مرتبط با کاربر
            Subscribe::create([
                'subscribe_user_id'        => $userId,
                'subscribe_plan_id'        => $plan->plan_id,
                'subscribe_download_limit' => $plan->plan_download_limit,
                'subscribe_download_count' => 0,
                'subscribe_expired_at'     => now()->addDays($plan->plan_day),
                'subscribe_id_payment_amount' => $plan->plan_price, // مقدار ستون ضروری
            ]);

        });

        // بازگشت با پیام موفقیت
        return redirect()->route('frontend.plan.buy')
                        ->with('success', 'پرداخت با موفقیت انجام شد و اشتراک فعال شد.');
    }


}
