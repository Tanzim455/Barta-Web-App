<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CommentController extends Controller
{
    //
   public function store(Request $request){

    $request->validate([
          'description'=>'required|max:500'
    ]);
    $userId = Auth::user()?->id;
    $uuId = Str::uuid()->toString();
    DB::table('comments')->insert([
        'description' => $request->input('description'),
         'uuid'=>$uuId,
        'user_id' => $userId,
        'post_id'=>$request->input('post_id')

    ]);
   }
}
