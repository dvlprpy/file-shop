<?php

use App\Http\Controllers\Admin\AdminUserListController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Frontend\FrontEndFileController;
use App\Http\Controllers\Frontend\FrontEndPackageController;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Package;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\Frontend\FakeGatewayController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\LogoutController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\DashboardController;


/* User Routes */
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['namespace' => 'Frondend'], function () {

    /* Login */
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('login', [LoginController::class, 'login'])->name('login');

    /* Register */
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('register', [RegisterController::class, 'register'])->name('register');

    /* Logout */
    Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

    /* User Dashboard */
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('user.dashboard');

    /* File & Package Details */
    Route::get('/file/{file_id}', [FrontEndFileController::class, 'detail'])->name('frontend.file.detail');
    Route::get('/package/{package_id}', [FrontEndPackageController::class, 'detail'])->name('frontend.package.detail');
    Route::get('/file/{id}/thumbnail', [FrontEndFileController::class, 'privateThumbnail'])
     ->name('files.private.thumbnail');

     // Load more فایل‌ها
    Route::get('/files/load_more', [FrontEndFileController::class, 'loadMore'])->name('frontend.files.load_more');

    // Load more پکیج‌ها
    Route::get('/packages/load_more', [FrontEndPackageController::class, 'loadMore'])->name('frontend.packages.load_more');


    /* Download File */
    Route::get('/file/{file_id}/download', [FrontEndFileController::class, 'download'])->name('frontend.file.download');
    
    /* Download Package */
    Route::get('/package/{package_id}/download', [FrontEndFileController::class, 'download'])->name('frontend.package.download');


    /* list of Active plan */
    Route::get('/plan', [HomeController::class, 'planBuy'])->name('frontend.plan.buy');


    /* purchase plan */
    Route::get('/plan/{plan_id}/purchase', [HomeController::class, 'purchase'])->name('frontend.plan.purchase_plan');

    
    /* Payment GateWay */
    Route::get('/fake-gateway/show/{plan_id}', [FakeGatewayController::class, 'show'])->name('fake.gateway.show');
    Route::post('/fake-gateway/pay', [FakeGatewayController::class, 'pay'])->name('fake.gateway.pay');
});



Route::get('/admin', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard.index');


/* Admin Routes */
Route::group(['prefix' => '/admin'], function () {

    /* 
        * User Route
    */

    /* User list  */
    Route::get('/user/list', [AdminUserListController::class, 'list'])->name('admin.user.list');

    /* show user form for create a new user  */
    Route::get('/user/create', [AdminUserListController::class, 'create'])->name('admin.user.create');

    /* submit and create a new user with "POST" */
    Route::post('/user/create', [AdminUserListController::class, 'store'])->name('admin.user.store');

    /* Delet User */
    Route::get('/user/delete/{user:user_id}', [AdminUserListController::class, 'delete'])->name('admin.user.delete');

    /* Edit User: get user info from database and show in form */
    Route::get('/user/edit/{user:user_id}', [AdminUserListController::class, 'edit'])->name('admin.user.edit');

    // اگر می‌خوای با POST+_method هم کار کنه:
    Route::match(['PUT', 'POST'], '/user/edit/{user:user_id}', [AdminUserListController::class, 'update'])->name('admin.user.update');
    
    /* Show User Package */
    Route::get('/user/package/{user:user_id}', [AdminUserListController::class, 'package'])->name('admin.user.package');

    /* Delete User Package */
    Route::delete('/user/{user:user_id}/package/{package:package_id}', [AdminUserListController::class, 'deleteUserPackage'])->name('admin.user.package.delete');

    /* Select Packages */
    Route::get('/user/selectPackage/{user:user_id}', [AdminUserListController::class, 'selectPackage'])->name('admin.user.selectPackage');

    /* Update Select Packages */
    Route::post('/user/updatePackage/{user:user_id}', [AdminUserListController::class, 'updateSelectPackage'])->name('admin.user.updateSelectPackage');





    /*
        File Route
    */
    Route::resource('/file', FileController::class);

    /* Download Route */
    Route::get('/file/{file:file_id}/download', [FileController::class, 'download'])->name('file.download');

    /* View Route */
    Route::get('/file/{file:file_id}/view', [FileController::class, 'view'])->name('file.view');

    /* AccessFile View Route */
    Route::get('/file/{file:file_id}/access', [FileController::class, 'accessFile'])->name('access.file');



    /* 
        Plan Route
    */
    Route::resource('/plan', PlanController::class);



    /* 
        Packages Route
    */
    Route::resource('/package', PackageController::class);

    /* Define this route for create Many-to-many relation  */
    Route::get('/package/syncFile/{package_id}', [PackageController::class, 'editSyncFile'])->name('package.editSyncFile');
    Route::post('/package/syncFile/{package_id}', [PackageController::class, 'updateSyncFile'])->name('package.updateSyncFile');



    /* 
        Payment Route
    */
    Route::resource('payment', PaymentController::class)->only([
        'index', 'destroy'
    ]);


     /* 
        Category Route
    */
    Route::resource('category', CategoryController::class)->except(['show']);
});