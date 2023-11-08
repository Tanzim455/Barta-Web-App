<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function registerpage(){
        return view('register');
    }
    public function register(RegisterRequest $request){

        User::create($request->validated());
    }
    public function login(){
        return view('login');
    }
}
