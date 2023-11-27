<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function edit()
    {
        return view('edit-profile');
    }

    
    public function profile($username)
    {
        
        //Fetch all 
        $user = DB::table('users')
        ->select('users.id', 'users.username', 'users.name', 'users.bio')
        ->where('username', $username)
        ->first();
         
        $userposts=DB::table('users')
        ->select('users.name','users.username','posts.description','posts.uuid')
        ->join('posts','posts.user_id','users.id')
        ->where('username', $username)
        ->get();
         
        
          return view('profile',compact('user','userposts'));
       
        

}
public function singleuserposts($username)
    {
        
    
        $user = DB::table('users')
        ->select('users.id', 'users.username', 'users.name', 'users.bio','posts.description')
        ->where('username', $username)
        ->first();

        
         return view('profile',compact('user'));
       
        

}
    public function update(ProfileUpdateRequest $request)
    {
        $id = Auth::user()?->id;
        $requestData = $request->validated();

        // If password is provided, hash it
        if ($request->filled('password')) {
            $requestData['password'] = Hash::make($request->input('password'));
        }
        if (! $request->filled('password')) {
            unset($requestData['password']);
        }

        DB::table('users')
            ->where('id', $id)
            ->update($requestData);

        return redirect()->back()->with('success', 'Your profile has been updated successfully');
    }
}