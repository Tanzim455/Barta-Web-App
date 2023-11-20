<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostsController;
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

 


Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'registerpage')->name('registerpage');
    Route::post('register', 'register')->name('register');
    Route::get('login', 'loginpage')->name('loginpage');
    Route::post('login', 'login')->name('login');
    
    Route::get('logout','logout')->name('logout');
    
    
});


Route::controller(ProfileController::class)->group(function () {
  
    // Route::get('profile', 'profile')->name('viewprofile')->middleware('auth');
    Route::middleware('auth')->group(function () {
        Route::get('edit-profile', 'editprofile')->name('edit-profile');
        Route::post('update-profile', 'updateprofile')->name('update-profile');
        Route::get('profile',[ProfileController::class,'profile'])->name('viewprofile');

    });
    
    // Route::post('posts',[PostsController::class,'store'])
    // ->name('posts.store')
    // ->middleware('auth');
     Route::resource('posts',PostsController::class);
    
});