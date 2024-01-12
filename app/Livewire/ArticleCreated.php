<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ArticleCreated extends Component
{
    #[Validate('required')] 
    public $title = '';
    public function save(){
        $this->validate(); 
 
        
        Article::create(
            $this->only(['title'])
        );
    }
    
    public function render()
    {
        return view('livewire.article-created');
    }
}
