<?php

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

Route::get('/', [PostsController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::post('update-profile',[ProfileController::class,'update'])->name('update-profile');
    

    
    
});
Route::resource('posts', PostsController::class);

require __DIR__.'/auth.php';
