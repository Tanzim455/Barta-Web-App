<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function registerpage()
    {
        return $this->redirectifAuthenticated(page: 'register');
    }

    public function register(RegisterRequest $request)
    {
        //Validating all data
        $requestData = $request->validated();

        // Hash the password if provided
        $hashedPassword = Hash::make($request->password);

        //Change the value of password to hashed password
        $requestData['password'] = $hashedPassword;

        // Insert the user data into the 'users' table
        $user = DB::table('users')->insert($requestData);

        if ($user) {
            return redirect()->route('register')->with('success', 'You are successfully registered');
        } else {
            return redirect()->route('register')->with('error', 'Registration failed');
        }
    }

    public function redirectifAuthenticated(string $page)
    {
        if (Auth::check()) {
            return redirect()->back();
        }

        return view($page);
    }

    public function loginpage()
    {
        //  return $this->redirectifAuthenticated(page:'login');
        return view('login');

    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->intended('/');
        }

        return to_route('login')->with('message', 'Wrong credentials please enter correct email and password');
    }

    public function logout()
    {
        //Session::flush();
        Auth::logout();

        return to_route('login');
    }
}
