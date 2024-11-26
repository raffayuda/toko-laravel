<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;

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
});

