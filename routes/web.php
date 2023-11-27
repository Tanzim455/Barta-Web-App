<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
Route::get('/',function(){
    return view('login');
})->middleware('guest');
Route::get('/home', [PostsController::class, 'index'])->name('home')->middleware('auth');

Route::middleware('auth')->group(function () {
    
    Route::get('edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::post('update-profile',[ProfileController::class,'update'])->name('update-profile');
    });
Route::resource('posts', PostsController::class);

require __DIR__.'/auth.php';

Route::get('/{user}', [ProfileController::class, 'profile'])->where('user', '[A-Za-z0-9_]+')->name('profile');
