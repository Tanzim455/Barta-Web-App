<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        //Validating all data
        $requestData = $request->validated();

        // Hash the password if provided
        $hashedPassword = Hash::make($request->password);

        //Change the value of password to hashed password
        $requestData['password'] = $hashedPassword;

        // Insert the user data into the 'users' table
        $user = User::create($requestData);

        if ($user) {
            return redirect()->route('register')->with('success', 'You are successfully registered');
        }
        if (! $user) {
            return redirect()->route('register')->with('error', 'Registration failed');
        }
    }
}
