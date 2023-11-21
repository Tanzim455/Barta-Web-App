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
        $this->middleware('auth')->only(['edit', 'update', 'destroy']);
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

        $post = DB::table('posts')
            ->join('users', 'posts.user_id', 'users.id')
            ->where('uuid', $uuid)->first();

        if ($post) {
            return view('posts.single', ['post' => $post]);
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
    public function destroy(string $id)
    {
        //
        DB::table('posts')->where('id', $id)->delete();

        return redirect()
            ->back()
            ->with('success', 'Country deleted');
    }
}
