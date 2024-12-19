<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\GenresController;
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
    // return redirect()->route('movie.index');
});
Route::prefix('movie')->group(function () {
    Route::get('/', [MoviesController::class, 'index'])->name('movie.index');
    Route::get('/delete/{id}', [MoviesController::class, 'delete'])->name('movie.delete');
    Route::get('/create/{id?}', [MoviesController::class, 'create'])->name('movie.create');
    Route::post('/store/{id?}', [MoviesController::class, 'store'])->name('movie.store');
    Route::prefix('submovie')->group(function () {
        Route::get('list/{id}/{name}', [SubMoviesController::class, 'index'])->name('submovie.index');
        Route::get('create/{movie_id}/{id?}', [SubMoviesController::class, 'create'])->name('submovie.create');
        Route::post('store/{movie_id}/{id?}', [SubMoviesController::class, 'store'])->name('submovie.store');
        Route::get('detail/{id}', [SubMoviesController::class, 'detail'])->name('submovie.detail');
        Route::get('watch/{id}', [SubMoviesController::class, 'watch'])->name('submovie.watch');
        Route::get('delete/{id}', [SubMoviesController::class, 'delete'])->name('submovie.delete');
        Route::get('episodes/{id}/{name}', [EpisodesController::class, 'index'])->name('episodes.index');
        Route::get('episodes/delete/{id}', [EpisodesController::class, 'delete'])->name('episodes.delete');
    });
});
Route::prefix('user')->group(function(){
    Route::get('/', [UsersController::class, 'index'])->name('user.index');
});
Route::prefix('genre')->group(function(){
    Route::get('/', [GenresController::class, 'index'])->name('genre.index');
    Route::get('delete/{id}', [GenresController::class, 'delete'])->name('genre.delete');
});

// Xử lý đăng nhập / đăng xuất
Route::get('/login', [UsersController::class, 'login'])->name('login');
Route::get('/create', [UsersController::class, 'create'])->name('create');
Route::post('/register', [UsersController::class, 'register'])->name('register');
Route::post('/logon', [UsersController::class, 'logon'])->middleware('web')->name('logon');

// Bảo vệ bởi authentication => phải đăng nhập mới có quyền truy cập
Route::middleware('auth')->prefix('/admin')->group(function(){    
    Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/logout', [UsersController::class, 'logout'])->name('admin.logout');
});
