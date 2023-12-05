<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

        $user = User::select('id', 'name', 'bio')->where('username', $username)->first();
           
        $userExists= User::withCount('posts')->where('username', $username)->first();
       
            $countofPosts=$userExists?->posts_count;
            $commentsOfUserPostsCount = Comment::fromUserPosts($user?->id)->count();
            
         
        //Count all comments of specific post of the user
           
            
           
        
        

        //All user posts with comment count
        $userposts = Post::withUserCommentsCount($username)->get();

        //Find all comment count of posts with specific username
        //Find all comments count of
        return view('profile', compact('user', 'userposts', 'countofPosts', 'commentsOfUserPostsCount'));

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
        $fileName = time().'.'.$request->image->extension();
        $request->image->storeAs('public/profile/images', $fileName);
        $requestData['image'] = $fileName;

        User::where('id', $id)->update($requestData);

        return redirect()->back()->with('success', 'Your profile has been updated successfully');
    }
}
