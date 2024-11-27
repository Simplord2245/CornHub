<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\SubMoviesController;
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
Route::get('/movie', [MoviesController::class,'index'])->name('movie.index');
Route::get('/movie/submovie', [SubMoviesController::class,'index'])->name('submovie.index');
// Xử lý đăng nhập / đăng xuất
Route::get('/login', [UsersController::class, 'login'])->name('login');
Route::get('/create', [UsersController::class, 'create'])->name('create');
Route::get('/register', [UsersController::class, 'register'])->name('register');
Route::post('/logon', [UsersController::class, 'logon'])->name('logon');

// Bảo vệ bởi authentication => phải đăng nhập mới có quyền truy cập
Route::middleware('auth')->prefix('/admin')->group(function(){    
    Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/logout', [UsersController::class, 'logout'])->name('admin.logout');
});
