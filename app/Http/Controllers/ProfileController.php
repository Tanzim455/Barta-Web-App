<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function editprofile(){
        return view('edit-profile');
    }
    public function profile(){
        return view('profile');
    }
    public function updateprofile(Request $request){


        $user = User::findOrFail(Auth::user()?->id);

        $user->first_name =$request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');
        $user->password =$request->input('password');
        $user->update();

       return redirect()->back()->with('success','Your profile has been updated successfully');




    }
}
