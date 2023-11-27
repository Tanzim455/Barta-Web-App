<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [PostsController::class, 'index']);

$username="tanzim45";
// Route::get('test',function() use ($username){
//       $user=User::findorFail($username);
//       dd($user);
// });

Route::get('/{username}',[ProfileController::class,'profile'])->name('profile');


Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::post('update-profile',[ProfileController::class,'update'])->name('update-profile');
    

    
    
});
Route::resource('posts', PostsController::class);

require __DIR__.'/auth.php';
