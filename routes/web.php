<?php

/* Admin Controller */
use App\Http\Controllers\Admin\AdminUserListController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\DownloadStatsController;
use App\Http\Controllers\Auth\ForgotPasswordController;

/* Front End Controller */
use App\Http\Controllers\Frontend\FrontEndFileController;
use App\Http\Controllers\Frontend\FrontEndPackageController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FrontEndCategoryController;
use App\Http\Controllers\Frontend\FakeGatewayController;
use App\Http\Controllers\Frontend\DashboardController;

/* Auth Controller */
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

/* Other */
use App\Models\Package;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

/* MiddleWare */
use App\Http\Middleware\AdminMiddleWare;
use App\Http\Middleware\userDashboardMiddleWare;
use App\Http\Middleware\UserLoginSweetAlert;

/* User Routes */
Route::get('/', [HomeController::class, 'index'])->name('home');



/* ===============================
 |   Frontend Routes
 =============================== */
Route::group([], function () {

    /* -------------------------------
     | Authentication
     ------------------------------- */
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('frontend.login.form');
    Route::post('login', [LoginController::class, 'login'])->name('frontend.login');

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('frontend.register.form');
    Route::post('register', [RegisterController::class, 'register'])->name('frontend.register');

    // 🔴 پیشنهاد میشه POST باشه
    Route::post('logout', [LogoutController::class, 'logout'])->name('frontend.logout');


    /* -------------------------------
     | Forgot Password
     ------------------------------- */
    Route::prefix('password/forgot')->name('password.forgot.')->group(function(){
        Route::get('/', [ForgotPasswordController::class, 'showRquestEmaliForm'])->name('form');
        Route::post('/', [ForgotPasswordController::class, 'showResetEmail'])->name('form.request');

        Route::get('/verify', [ForgotPasswordController::class, 'verifyToken'])->name('verify');
        Route::post('/verifyMail', [ForgotPasswordController::class, 'verify'])->name('verify.update');

        Route::get('/reset', [ForgotPasswordController::class, 'showResetForm'])->name('reset');
        Route::post('/reset', [ForgotPasswordController::class, 'reset'])->name('update');
    });




    /* -------------------------------
     | User Dashboard
     ------------------------------- */
    Route::middleware(userDashboardMiddleWare::class)->prefix('dashboard')->name('frontend.user.dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'Dashboard'])->name('show');
        Route::get('/info', [DashboardController::class, 'Info'])->name('info');
        Route::get('/edit', [DashboardController::class, 'Edit'])->name('edit');
        Route::match(['PUT', 'POST'], '/update', [DashboardController::class, 'Update'])->name('update');
        Route::get('/plans', [DashboardController::class, 'Plan'])->name('plan');
    });


    /* -------------------------------
     | Files
     ------------------------------- */
    Route::middleware(UserLoginSweetAlert::class)->prefix('file')->name('frontend.file.')->group(function () {
        Route::get('{file_id}', [FrontEndFileController::class, 'detail'])->name('detail');
        Route::get('{file_id}/download', [FrontEndFileController::class, 'download'])->name('download');
        Route::get('{id}/thumbnail', [FrontEndFileController::class, 'privateThumbnail'])->name('thumbnail');
    });
    Route::get('files/load_more', [FrontEndFileController::class, 'loadMore'])->name('frontend.files.load_more');


    /* -------------------------------
     | Packages
     ------------------------------- */
    Route::middleware(UserLoginSweetAlert::class)->prefix('package')->name('frontend.package.')->group(function () {
        Route::get('{package_id}', [FrontEndPackageController::class, 'detail'])->name('detail');
        Route::get('{package_id}/download', [FrontEndPackageController::class, 'download'])->name('download');
    });
    Route::get('packages/load_more', [FrontEndPackageController::class, 'loadMore'])->name('frontend.packages.load_more');


    /* -------------------------------
     | Plans
     ------------------------------- */
    Route::get('plan', [HomeController::class, 'planBuy'])->name('frontend.plan.buy');
    Route::get('plan/{plan_id}/purchase', [HomeController::class, 'purchase'])->name('frontend.plan.purchase');


    /* -------------------------------
     | Payment Gateway
     ------------------------------- */
    Route::prefix('fake-gateway')->name('frontend.fake.gateway.')->group(function () {
        Route::get('show/{plan_id}', [FakeGatewayController::class, 'show'])->name('show');
        Route::post('pay', [FakeGatewayController::class, 'pay'])->name('pay');
    });


    /* -------------------------------
     | Category
     ------------------------------- */
    Route::prefix('/category')->name('frontend.category.')->group(function () {
        Route::get('/detail/{category_id}', [FrontEndCategoryController::class, 'detail'])->name('detail');
    });
});




/*--------------------------------------
| Admin Routes (Only for Admins)
| Prefix: /admin
| Middleware: auth, AdminMiddleWare
---------------------------------------*/
Route::group(['prefix' => 'admin', 'middleware' => [AdminMiddleWare::class]], function () {

    /* 🔹 Dashboard */
    Route::get('/', [DownloadStatsController::class, 'index'])->name('admin.dashboard.index');

    /* 🔹 User Management */
    Route::prefix('user')->name('admin.user.')->group(function () {
        Route::get('/list', [AdminUserListController::class, 'list'])->name('list');
        Route::get('/create', [AdminUserListController::class, 'create'])->name('create');
        Route::post('/create', [AdminUserListController::class, 'store'])->name('store');
        Route::get('/delete/{user:user_id}', [AdminUserListController::class, 'delete'])->name('delete');
        Route::get('/edit/{user:user_id}', [AdminUserListController::class, 'edit'])->name('edit');
        Route::match(['PUT', 'POST'], '/edit/{user:user_id}', [AdminUserListController::class, 'update'])->name('update');

        // User packages
        Route::get('/package/{user:user_id}', [AdminUserListController::class, 'package'])->name('package');
        Route::delete('/{user:user_id}/package/{package:package_id}', [AdminUserListController::class, 'deleteUserPackage'])->name('package.delete');
        Route::get('/selectPackage/{user:user_id}', [AdminUserListController::class, 'selectPackage'])->name('selectPackage');
        Route::post('/updatePackage/{user:user_id}', [AdminUserListController::class, 'updateSelectPackage'])->name('updateSelectPackage');
    });

    /* 🔹 File Management */
    Route::resource('file', FileController::class);
    Route::get('file/{file:file_id}/download', [FileController::class, 'download'])->name('file.download');
    Route::get('file/{file:file_id}/view', [FileController::class, 'view'])->name('file.view');
    Route::get('file/{file:file_id}/access', [FileController::class, 'accessFile'])->name('access.file');

    /* 🔹 Plan Management */
    Route::resource('plan', PlanController::class);

    /* 🔹 Package Management */
    Route::resource('package', PackageController::class);
    Route::get('package/syncFile/{package_id}', [PackageController::class, 'editSyncFile'])->name('package.editSyncFile');
    Route::post('package/syncFile/{package_id}', [PackageController::class, 'updateSyncFile'])->name('package.updateSyncFile');

    /* 🔹 Payment Management */
    Route::resource('payment', PaymentController::class)->only(['index', 'destroy']);

    /* 🔹 Category Management */
    Route::resource('category', CategoryController::class)->except(['show']);
});