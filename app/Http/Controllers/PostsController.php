<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->get();

        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.


     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'description' => 'required|max:1000',
        ]);

        $userId = Auth::user()?->id;
        $uuId = Str::uuid()->toString();
        DB::table('posts')->insert([
            'description' => $request->input('description'),
            'user_id' => $userId,
            'uuid' => $uuId,

        ]);

        return redirect()
            ->back()
            ->with('success', 'Post added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        //
        //Get users of single post
        $post = DB::table('posts')
        ->select('posts.id')
             ->where('uuid', $uuid)
             ->first();
       //dump($post->id);
       
        $postuserdetails=DB::table('posts')
        
        ->join('users','posts.user_id','users.id')
        ->select('users.name','users.username','posts.id','posts.user_id','posts.uuid','posts.description')
        ->where('posts.id',$post->id)->first();

 
        $comments = DB::table('comments')
        ->select('users.name', 'users.username', 'comments.description')
        ->join('users', 'comments.user_id', 'users.id')
            
            ->where('comments.post_id', $post->id)->get();
        //Comment count
        
        $count = DB::table('comments')
            ->select('users.name', 'users.username', 'comments.description')
            ->join('users', 'comments.user_id', 'users.id')
            ->where('post_id', $post->id)->count();
            
            
        if ($post) {
            return view('posts.single', ['postuserdetails' => $postuserdetails, 'comments' => $comments, 'count' => $count]);
        } else {
            return redirect('/posts');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        //
        $post = DB::table('posts')->where('uuid', $uuid)->first();

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        //
        $request->validate([
            'description' => 'required|max:1000',
        ]);

        DB::table('posts')
            ->where('uuid', $uuid)
            ->update([
                'description' => $request->description,
            ]);

        return redirect()
            ->back()
            ->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        //

        DB::table('posts')->where('uuid', $uuid)->delete();

        return redirect()
            ->back()
            ->with('success', 'Your post has been deleted');
    }
}
