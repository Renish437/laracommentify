<?php

namespace CodeWithRen\LaraCommentify\Livewire;

use App\Livewire\Forms\CommentForm;
use CodeWithRen\LaraCommentify\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Model $model;

    public CommentForm $form;

    public function mount($model){
        $this->model = $model;
        
    }
    public function render()
    {
        

        return view('laracommentify::livewire.comments', [
            'comments' => $this->model
            ->comments()
            ->with('user', 'replies.user','replies.replies')
            ->parent()
            ->latest()
            ->paginate(3),
        ]);
    }
    public function postComment(){
        $this->form->storeComment($this->model);
        $this->resetPage();
    }

    #[On('deleteComment')]
    public function deleteComment($comment)
    {
      $comment = Comment::find($comment);
    //   dd($comment);
       $this->authorize('delete', $comment);
      $comment->delete();
     

   }
  
}
