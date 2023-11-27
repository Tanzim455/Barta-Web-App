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

        //Fetch information about users profile
        $user = DB::table('users')
            ->select('users.id', 'users.username', 'users.name', 'users.bio')
            ->where('username', $username)
            ->first();
        //Fetch information about all post of the user
        $userposts = DB::table('users')
            ->select('users.name', 'users.username', 'posts.id', 'posts.description', 'posts.uuid', 'posts.user_id')
            ->join('posts', 'posts.user_id', 'users.id')
            ->where('username', $username)
            ->get();
        //Count all post the specific user
        $countofPosts = DB::table('posts')
            ->where('posts.user_id', $user->id)->count();

        //Count all comments of specific post of the user
        $commentsOfUserPostsCount = DB::table('comments')
            ->select('comments.post_id')
            ->whereIn('comments.post_id', function ($query) use ($user) {
                $query->select('id')
                    ->from('posts')
                    ->where('posts.user_id', $user->id);
            })->count();

        return view('profile', compact('user', 'userposts', 'countofPosts', 'commentsOfUserPostsCount'));

    }

    public function singleuserposts($username)
    {

        $user = DB::table('users')
            ->select('users.id', 'users.username', 'users.name', 'users.bio', 'posts.description')
            ->where('username', $username)
            ->first();

        return view('profile', compact('user'));

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
