<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|max:500',
        ]);
    
        $userId = Auth::user()?->id;
        $uuId = Str::uuid()->toString();
    
        $comment = Comment::create([
            'description' => $request->input('description'),
            'uuid' => $uuId,
            'user_id' => $userId,
            'post_id' => $request->input('post_id'),
        ]);
    
        // Assuming there is a relationship between Comment and Post models
        $post = Post::findOrFail($comment->post_id);
        
        // Assuming CommentNotification constructor expects a Post instance as the first argument
        // and a Comment instance as the second argument
        $post->user->notify(new CommentNotification($post, $comment));
    
        return redirect()->back()->with('success', 'Your comment has been posted successfully');
    }
}
