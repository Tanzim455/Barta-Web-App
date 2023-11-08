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

        $user=User::create($request->validated());
        if($user){
            return to_route('register')->with('success', 'You are succesfully registered');
        }
    }
    public function login(){
        return view('login');
    }
}
