<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function registerpage(){
        return $this->redirectifAuthenticated(page:'register');
    }
    public function register(RegisterRequest $request){

        $user=User::create($request->validated());
        if($user){
            return to_route('register')->with('success', 'You are succesfully registered');
        }
    }
    public function redirectifAuthenticated(string $page){
        if(Auth::check()){
            return redirect()->back();
        }

        return view($page);
    }
    public function loginpage(){
        //  return $this->redirectifAuthenticated(page:'login');
        return view('login');

    }
    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return to_route('login')->with('message', 'Wrong credentials please enter correct email and password');
    }

    public function logout() {
        //Session::flush();
        Auth::logout();

        return to_route('login');
    }
}
