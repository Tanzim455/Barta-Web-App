<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function editprofile(){
        return view('edit-profile');
    }
    public function profile(){
        return view('profile');
    }
}
