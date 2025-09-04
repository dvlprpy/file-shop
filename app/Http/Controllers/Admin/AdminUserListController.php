<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSelectedUserPackage;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AdminUserListController extends Controller
{

    /* Function For List of All User */
    public function list()
    {
        $user = User::all();
        return view('admin.user.list', compact('user'));
    }


    /* Redirect to User Create Form */
    public function create()
    {
        return view('admin.user.create');
    }

    /* Create New User */
    public function store(Request $request)
    {
        // اعتبارسنجی
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:100|regex:/^[\p{Arabic}a-zA-Z0-9\s]+$/u',
            'username' => 'required|string|max:50|unique:users|regex:/^[a-zA-Z0-9]+$/',
            'password' => 'required|string|min:8|max:15|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
            'phone' => 'required|string|digits:11|unique:users|regex:/^09[0-9]{9}$/',
            'email' => 'required|email|max:200|unique:users',
            'role' => 'required|string|max:15|in:normaluser,seller,adminsystem',
            'wallet' => 'nullable|numeric|min:0',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()
            ], 422);
        }


        $validated = $validator->validated();


        // ذخیره تصویر پروفایل در صورت وجود
        if ($request->hasFile('profile_picture')) {
            $extension = strtolower($request->file('profile_picture')->getClientOriginalExtension());

            // تولید نام با تاریخ + شناسه یکتا
            $fileName = now()->format('Y-m-d_H-i-s') . '_' . uniqid('profile_', true) . '.' . $extension;

            // ذخیره در مسیر public/profile_pictures
            $path = $request->file('profile_picture')->storeAs('profile_pictures', $fileName, 'public');

            $validated['profile_picture'] = $path;
        } else {
            // اگر کاربر عکسی نداد → پیش‌فرض بذار
            $validated['profile_picture'] = 'images/default-avatar.svg';
        }



        // تنظیم مقادیر اضافی
        // $validated['password'] = Hash::make($validated['password']);

    
        // تعیین role و wallet بر اساس نقش ثبت‌کننده
        if (Auth::check() && Auth::user()->role === 'adminsystem') {
            if ($request->filled('wallet')) {
                $validated['wallet'] = $request->wallet;
            }
            if ($request->filled('role')) {
                $validated['role'] = $request->role;
            }
        } else {
            $validated['wallet'] = 0;
            $validated['role'] = 'normaluser';
        }


        // ایجاد کاربر
        /* 
            توجه کنید که این روش فراخوانی یعنی فراخوانی متد Static create() از مدل User روش امنیتی هست که مواردی که در فایل مدل User.php به عنوان fillable, hidden, guarded تنظیم کردیم را چک میکند 
            ولی ما از این مدل User یک آبجکت می سازیم موقتا که این محدودیت را دور بزنیم.
        */
        // User::create($validated) 


        /* روش ناایمن */
        $user = new User($validated);
        $user->role = $request->role;
        $user->wallet = $request->wallet;
        $user->save();


        // پاسخ موفقیت همراه با مسیر ریدایرکت
        return response()->json([
            'message'       => 'کاربر با موفقیت ثبت شد',
            'redirect_url' => route('admin.user.list')
        ]);
    }


    /* Delet User */
    public function delete($user_id)
    {

        if ($user_id && ctype_digit($user_id)) {
            
            $find_user_id = User::find($user_id);

            if ($find_user_id && $find_user_id instanceof User) {
                
                $find_user_id->delete();

                return redirect()->route('admin.user.list')->with('success', 'کاربر مورد نظر با موفقیت حذف گردید.');
            }
        }

    }


    /* Edit User */
    public function edit($user_id){

        if ($user_id && ctype_digit($user_id)) {
            
            $user_item = User::find($user_id);

            if ($user_item && $user_item instanceof User) {
                
                return view('admin.user.edit', compact('user_item'));
            }
        }
    }


    /* update User */
    public function update(Request $request, $user_id)
    {
       $user = User::findOrFail($user_id);

        $validated = $request->validate([
            'fullname'        => 'required|string|max:255',
            'username'        => 'required|string|max:255|unique:users,username,' . $user->user_id . ',user_id',
            'email'           => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'phone'           => 'required|string|max:15',
            'password'        => 'nullable|string|min:8',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // اگر عکس جدید آپلود شد
        if ($request->hasFile('profile_picture')) {
            $extension = strtolower($request->file('profile_picture')->getClientOriginalExtension());
            $fileName = now()->format('Y-m-d_H-i-s') . '_' . uniqid('profile_', true) . '.' . $extension;

            $path = $request->file('profile_picture')->storeAs('profile_pictures', $fileName, 'public');
            $user->profile_picture = $path;
        }

        // اگر پسورد جدید وارد شد
        if (!empty($validated['password'])) {
            $user->password = $validated['password']; // چون تو مدل setPasswordAttribute داری، خودش bcrypt می‌شه
        }

        // role و wallet فقط برای ادمین
        if (Auth::check() && Auth::user()->role === 'adminsystem') {
            if ($request->filled('wallet')) {
                $user->wallet = $request->wallet;
            }
            if ($request->filled('role')) {
                $user->role = $request->role;
            }
        }

        // فیلدهای ساده
        $user->fullname = $validated['fullname'];
        $user->username = $validated['username'];
        $user->email    = $validated['email'];
        $user->phone    = $validated['phone'];
        $user->role = $request->role;
        $user->wallet = $request->wallet;

        $user->save();

        return response()->json([
            'message'      => 'کاربر با موفقیت ویرایش شد.',
            'redirect_url' => route('admin.user.list'),
        ], 200);
    }


    /* User Packages */
    public function package(Request $request, $user_id)
    {
        $user_find = User::where('user_id', $user_id)->firstOrFail();
        
        $find_user_package = $user_find->packages()->get();

        // dd($find_user_package);
        return view('admin.user.package', compact('user_find', 'find_user_package'));
    }


    /* Delete User Package */
    public function deleteUserPackage(User $user, Package $package)
    {
        $user->packages()->detach($package);

        return back()->with('success', 'پکیج مورد نظر با موفقیت حذف شد.');
    }



    /* Select Pacage */
    public function selectPackage($user_id)
    {
        $get_user_info = User::where('user_id', $user_id)->firstOrFail();

        $get_all_package = Package::all();

        return view('admin.user.selectPackage', compact('get_user_info', 'get_all_package'));
    }


    /* Update Select Package */
    public function updateSelectPackage(UpdateSelectedUserPackage $request, $user_id)
    {
        $user = User::where('user_id', $user_id)->firstOrFail();
        

        // بررسی اینکه packages به شکل آرایه ارسال شده است
        $packages = is_array($request->packages) ? $request->packages : [];

        // آماده کردن آرایه برای syncWithPivotValues
        $attachData = [];
        foreach ($packages as $packageId) {
            $package = Package::find($packageId); // قیمت را از دیتابیس بخوانید
            if ($package) {
                $attachData[$packageId] = [
                    'amount'     => $request->amount[$packageId] ?? $package->package_price,  // مقدار وارد شده توسط کاربر یا پیش‌فرض 1
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        // اضافه کردن پکیج‌ها بدون حذف پکیج‌های قبلی
        $user->packages()->syncWithoutDetaching($attachData);

        return redirect()->route('admin.user.list')->with('success', 'پکیج‌ها با موفقیت به کاربر اضافه شدند.');
    }

}
