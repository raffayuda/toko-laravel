<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', [AuthController::class, 'login_admin'])->name('login');
Route::post('admin', [AuthController::class, 'auth_login_admin']);
Route::get('admin/logout', [AuthController::class, 'logout_admin'])->middleware('auth');

Route::group(['middleware' => 'admin'], function () {
    // Route::get('admin/dashboard', function () {
    //     return view('admin.dashboard');
    // });

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    
    Route::resource('admin/admin/list', AdminController::class);
    Route::resource('admin/category', CategoryController::class);
    Route::resource('admin/subcategory', SubCategoryController::class);
    Route::resource('admin/product', ProductController::class);
    Route::resource('admin/brand', BrandController::class);
});

