<?php

namespace App\Livewire;

use Livewire\Component;

class CommentList extends Component
{
    public int $count;
    public $postWithComments;
    public function render()
    {
        return view('livewire.comment-list');
    }
}
