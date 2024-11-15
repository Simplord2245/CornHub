<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Xử lý đăng nhập / đăng xuất
Route::get('/', [UsersController::class, 'login'])->name('login');
Route::get('/create', [UsersController::class, 'create'])->name('create');
Route::get('/register', [UsersController::class, 'register'])->name('register');
Route::get('/logon', [UsersController::class, 'logon'])->name('logon');

// Bảo vệ bởi authentication => phải đăng nhập mới có quyền truy cập
Route::middleware('auth')->prefix('/admin')->group(function(){    
    Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/logout', [UsersController::class, 'logout'])->name('admin.logout');
});
