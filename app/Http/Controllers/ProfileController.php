<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function editprofile(){
        return view('edit-profile');
    }
    public function profile(){
        return view('profile');
    }
    public function updateprofile(ProfileUpdateRequest $request)
{
    $id = Auth::user()?->id;

    $updateData = [
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'email' => $request->input('email'),
        'bio' => $request->input('bio'),
    ];

    if ($request->filled('password')) {
        $updateData['password'] = Hash::make($request->input('password'));
    }

    DB::table('users')
        ->where('id', $id)
        ->update($updateData);

    return redirect()->back()->with('success', 'Your profile has been updated successfully');
}

    
    
}
