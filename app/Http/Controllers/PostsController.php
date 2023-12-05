<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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

        $posts = Post::withUserDetails()
            ->select('user_id', 'uuid', 'description', 'image')
            ->orderBy('id', 'DESC')->paginate(10);

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
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $userId = Auth::user()?->id;
        $uuId = Str::uuid()->toString();

        $post = Post::create([
            'description' => $request->input('description'),
            'user_id' => $userId,
            'uuid' => $uuId,
            'image'=>$request->input('image')
        ]

        );
        if($request->hasFile('image')){
             $fileName = time().'.'.$request->image->extension();
             
         $request->image->storeAs('public/images', $fileName);
         $post->image = $fileName;
         

        }

        $post->save();
        
        

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

        $post = Post::where('uuid', $uuid)->first();
        //get user of a single post
        $postuserdetails = Post::withUserDetails()->findorFail($post->id);
        //Comment count of posts
        $count = Post::withCount('comments')?->findorFail($post->id)->comments_count;

        //Get comment count of a post
        $postWithComments = Post::withUserComments()->findOrFail($post->id);

        if ($post) {
            return view('posts.single', ['postuserdetails' => $postuserdetails, 'postWithComments' => $postWithComments, 'count' => $count]);
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
        $post = Post::where('uuid', $uuid)->first();

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

        $post = Post::where('uuid', $uuid);
        $post->update(['description' => $request->description]);

        return redirect()
            ->back()
            ->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
{
    $post = Post::where('uuid', $uuid)->firstOrFail();
    $image = $post->image;

    // Delete the image using the Storage facade
    if (Storage::disk('public')->exists('images/' . $image)) {
        Storage::disk('public')->delete('images/' . $image);
    }

    // Delete the post
    $post->delete();

    // Redirect back with a success message
    return redirect()
        ->back()
        ->with('success', 'Your post and image have been deleted');
}
}
