<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search(Request $request){
      $search=$request->input('userprofile');
        $user=User::where('username','LIKE',"%{$search}%")
    ->orWhere('name','LIKE',"%{$search}%")
    ->orWhere('email','LIKE',"%{$search}%")
    ->first();
   
    if ($user) {
        return to_route('profile',['user'=>$user->username]);
    } else {
        return "User is not there";
    }
    }
    
}
