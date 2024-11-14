<?php

use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
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
    return view('index');
=======
Route::get('/', function () {
    return view('welcome');
>>>>>>> 90d89d6ade1dbb847f944f985afcb90b8f24306a
});
