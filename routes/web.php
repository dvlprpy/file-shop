<?php

use App\Http\Controllers\Admin\AdminUserListController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Package;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admin', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard.index');

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