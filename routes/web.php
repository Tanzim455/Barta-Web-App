<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Carbon\Carbon;
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
    
    return view('login');
})->middleware('guest');
Route::get('/home', [PostsController::class, 'index'])->name('home')->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::post('update-profile', [ProfileController::class, 'update'])->name('update-profile');
});
Route::resource('posts', PostsController::class);
Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/searchuser', [SearchController::class, 'search'])->name('searchuser')->middleware('auth');
Route::get('notifications',function(){
     $notifications=auth()?->user()?->notifications;
    //  foreach($notifications as $notification){
    //     dd($notification->data['data']);
    //  }

    return view('notification',compact('notifications'));
});
require __DIR__.'/auth.php';

Route::get('/{user}', [ProfileController::class, 'profile'])->where('user', '[A-Za-z0-9_]+')->name('profile');
