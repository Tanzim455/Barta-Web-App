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
})->name('home')->middleware('auth');
// Route::get('register',[AuthController::class,'registerpage'])->name('registerpage');
// Route::post('register',[AuthController::class,'register'])->name('register');
// Route::get('login',[AuthController::class,'loginpage'])->name('loginpage');
// Route::post('login',[AuthController::class,'login'])->name('login');
 Route::get('edit-profile',[ProfileController::class,'editprofile'])->name('edit-profile')->middleware('auth');
 Route::post('update-profile',[ProfileController::class,'updateprofile'])->name('update-profile')->middleware('auth');
Route::get('profile',[ProfileController::class,'profile'])->name('viewprofile')->middleware('auth');


Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'registerpage')->name('registerpage');
    Route::post('register', 'register')->name('register');
    Route::get('login', 'loginpage')->name('loginpage');
    Route::post('login', 'login')->name('login');
    
    Route::get('logout','logout')->name('logout');
    
    
});