<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;
    public int $page=1;
    public int $perPage=10;
    // public Collection $posts;
    // public function mount(){
    //     $this->posts=collect();
    //     $this->loadMore();
    // }
    // #[Computed()]
    // public function paginator(){
    //     return  ;
    // }
    public function render()
    {
        

        return view('livewire.home-page',[
            'posts'=>Post::withUserDetails()
            ->select('user_id', 'uuid', 'description', 'image')
            ->latest()->paginate($this->perPage, ['*'], 'page', $this->page)
        ]);
        return view('livewire.home-page');
    }
    public function loadMore(){
        
       $this->perPage +=10;
    }

}
