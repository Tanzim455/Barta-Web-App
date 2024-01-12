<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CommentCreated extends Component
{
    public $postuserdetails;
    public  $description;
    public $post_id;
    
    
public function mount()
{
    $this->post_id=$this->postuserdetails;
}
    public function save(){
        
        $validatedData=$this->validate([
            'description' => 'required|max:500',
            'post_id'=>'required'
        ]);
        $comment=Comment::create($validatedData);
        // $userId = Auth::user()?->id;
        // $uuId = Str::uuid()->toString();
    //    $this->reset('description');
       
   
          
        // Assuming there is a relationship between Comment and Post models
         $post = Post::findOrFail($comment->post_id);
        
        // Assuming CommentNotification constructor expects a Post instance as the first argument
        // and a Comment instance as the second argument
         $post->user->notify(new CommentNotification($post, $comment));
    
        session()->flash('success', 'Your comment has been posted successfully');
        
    }
    public function render()
    {
        return view('livewire.comment-created');
    }
}
