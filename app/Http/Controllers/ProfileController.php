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
        $requestData = $request->validated();
    
        // If password is provided, hash it
        if ($request->filled('password')) {
            $requestData['password'] = Hash::make($request->input('password'));
        } 
        if (!$request->filled('password')) {
            unset($requestData['password']);
        }
    
        DB::table('users')
            ->where('id', $id)
            ->update($requestData);
    
        return redirect()->back()->with('success', 'Your profile has been updated successfully');
    }

    
    
}
