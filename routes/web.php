<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
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
    return view('index');
});
Route::get('register',[AuthController::class,'register'])->name('registerage');
Route::get('login',[AuthController::class,'login'])->name('loginpage');
Route::get('edit-profile',[ProfileController::class,'editprofile'])->name('edit-profile');
Route::get('profile',[ProfileController::class,'profile'])->name('viewprofile');

