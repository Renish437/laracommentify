<?php

namespace CodeWithRen\LaraCommentify\Livewire;

use CodeWithRen\LaraCommentify\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class LikeComment extends Component
{
    
 public $comment;
    public $likes_count;

    
  
   
    public function mount(Comment $comment){
        $this->comment=$comment;
        $this->likes_count=$this->comment->likes()->count();
       
    }


    public function toggleLike()
{   
    $like = $this->comment->likes()->where('user_id', Auth::id())->first();

    if ($like) {
        $like->delete();
    } else {
        $this->comment->likes()->create(['user_id' => Auth::id()]);
    }

    $this->likes_count = $this->comment->likes()->count();
}

  
       

   
    public function render()
    {
        return view('laracommentify::livewire.like-comment');
    }
}
