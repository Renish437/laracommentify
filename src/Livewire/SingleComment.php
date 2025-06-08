<?php

namespace CodeWithRen\LaraCommentify\Livewire;

use CodeWithRen\LaraCommentify\Livewire\Forms\ReplyForm;
use CodeWithRen\LaraCommentify\Livewire\Forms\UpdateCommentForm;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFormObjects;
use CodeWithRen\LaraCommentify\Models\Comment;

class SingleComment extends Component
{
    use AuthorizesRequests;

    protected $listeners = ['deleteComment' => '$refresh'];

    public $comment;

    public $isReplying = false;
    public $isEditing = false;

    public ReplyForm $form;
    public UpdateCommentForm $updateForm;

    public $updateBody = '';

    public function formObjects()
    {
        return [
            'form' => ReplyForm::class,
            'updateForm' => UpdateCommentForm::class,
        ];
    }

    public function mount($comment)
    {
        $this->comment = $comment;

        $this->updateBody = $this->comment->body;
            $this->updateForm->fill([
        'body' => $this->comment->body,
    ]);
    }

    public function addReply()
    {
        if ($this->comment->isReply()) {
            return;
        }

        $this->form->storeReply($this->comment);
        $this->isReplying = false;
    }

    public function updateComment()
    {
        $this->authorize('update', $this->comment);
        $this->updateForm->body = $this->updateBody;
        $this->updateForm->updateComment($this->comment);
        $this->isEditing = false;
    }

    public function updatedIsEditing($value)
    {
        if ($value === true) {
            $this->updateBody = $this->comment->body;
            $this->updateForm->body = $this->comment->body;
            Log::info('updatedIsEditing triggered', ['body' => $this->updateForm->body]);
            $this->dispatch('update-textarea');
        }
    }

    public function updatedUpdateBody($value)
    {
        $this->updateForm->body = $value;
    }

    public function render()
    {
        return view('laracommentify::livewire.single-comment');
    }
}
