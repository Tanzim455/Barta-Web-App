<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;
    public function render()
    {
        $posts = Post::withUserDetails()
            ->select('user_id', 'uuid', 'description', 'image')
            ->orderBy('id', 'DESC')->paginate(10);

        return view('livewire.home-page', compact('posts'));
    }
}
