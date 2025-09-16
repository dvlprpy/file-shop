<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Mail\ForgotPasswordEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    // فرم درخواست ایمیل (GET)
    public function showRquestEmaliForm()
    {
        return view('frontend.userAuth.forgotPassword.password_forgot')->with('pageTitle', 'بازیابی رمز عبور');
    }


    // ارسال ایمیل ریست (POST)
    public function showResetEmail(ForgotPasswordRequest $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        // توکن تصادفی ایجاد کن
        $token = Str::random(10);

        // هش کردن توکن قبل از ذخیره برای امنیت
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ], 
        );

        // اگر کاربر موجود بود ایمیل بفرست (ولی پیغام موفقیت را برای همه یکسان بدهیم تا enumeration نشود)
        if ($user) {
            Mail::to($user->email)->send(new ForgotPasswordEmail($user, $token));
        }

        /* ذخیره ایمیل کاربر در سشن برای تایید و احراز هویت و ادامه فرآیند */
        session(['send_email' => $email]);

        return redirect()
            ->route('password.forgot.verify')
            ->with('sweetalert', [
                'title' => 'ارسال توکن امنیتی',
                'text' => 'کاربر گرامی سیستم در حال بررسی و تایید اطلاعات شما می باشد، چنانچه کاربری با این مشخصات در سیستم موجود باشد یک ایمیل حاوی کد تایید یا توکن امنیتی 10 رقمی برای شما اراسال خواهد شد لطفا تا 2 دقیقه دیگر ایمیل خود را چک کنید',
                'icon' => 'success',
                'confirmButtonText' => 'باشه'
            ]);
    }


    /* verify Token */
    public function verifyToken()
    {
        $userMail = session('send_email');
        return view('frontend.userAuth.forgotPassword.verify_mail', compact('userMail'))->with('pageTitle', 'کد تایید');
    }


    /* verify Email */
    public function verify(Request $request)
    {
        
        $request->validate([
            'token' => 'required|string'
        ]);

        $email = session('send_email');

        // رکورد را بر اساس ایمیل یا هرچیزی که داری بگیر
        $record = DB::table('password_reset_tokens')
            ->where('email', $email) // یا ایمیل از سشن/QueryString
            ->first();

        if (!$record) {
            return back()->withErrors(['token' => 'توکن نامعتبر یا منقضی شده است.']);
        }

        if (!Hash::check($request->token, $record->token)) {
            return back()->withErrors(['token' => 'توکن نادرست است.']);
        }

        // همه چیز درست بود
        return redirect()->route('password.forgot.reset', [
            'token' => $request->token,
            'email' => $record->email
        ]);
    }

    // نمایش فرم ریست (GET) — لینک از ایمیل می‌آید: /password/reset?token=...&email=...
    public function showResetForm(Request $request)
    {
        return view('frontend.userAuth.forgotPassword.password_reset')->with([
            'token' => $request->query('token'),
            'email' => $request->query('email'),
        ]);
    }


    // عمل ریست (POST)
    public function reset(Request $request)
    {
        $res = $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            'password_confirmation' => 'required|string|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ]);
        
        if ($request['password'] != $request['password_confirmation']) {
            return back()->withErrors(['password' => 'رمزعبور و تکرار آن یکسان نیست.']);
        }

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$record) {
            return back()->withErrors(['email' => 'توکن نامعتبر یا منقضی شده است.']);
        }

        // بررسی منقضی شدن توکن (مثلاً 60 دقیقه)
        if (Carbon::parse($record->created_at)->addMinutes(5)->isPast()) {
            // return back()->withErrors(['token' => 'توکن منقضی شده است. لطفاً دوباره درخواست دهید.']);
            return redirect()->route('password.forgot.form')->with('token_time_expire', [
                'title' => 'پایان زمان اعتبار توکن امنیتی',
                'text' => 'کاربر گرامی با توجه به اینکه توکن های امنیتی فقط 5 دقیقه اعتبار دارند لذا زمان اعتبار توکن امنیتی شما به پایان رسیده است لطفا دوباره تلاش کنید.',
                'icon' => 'error',
                'confirmButtonText' => 'باشه'
            ]);
        }

        // بررسی تطابق توکن (از آنجا که توکن در DB هش شده است از Hash::check استفاده می‌کنیم)
        if (!Hash::check($request->token, $record->token)) {
            return back()->withErrors(['token' => 'توکن نامعتبر است.']);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'اطلاعات وارد شده نا معتبر است.']);
        }
        $user->password = $request->password;
        $user->save();

        // حذف رکورد توکن
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // ورود خودکار کاربر (اختیاری)
        Auth::login($user);

        return redirect('/')->with('status', 'رمز عبور شما با موفقیت تغییر یافت.');
    }
}
