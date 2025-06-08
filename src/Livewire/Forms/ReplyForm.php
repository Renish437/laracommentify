<?php

namespace CodeWithRen\LaraCommentify\Livewire\Forms;

use CodeWithRen\LaraCommentify\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ReplyForm extends Form
{
    #[Rule('required', message: 'Please enter a reply')]
    public $body;

    public function storeReply(Comment $comment)
    {
        $this->validate();
        $reply = $comment->replies()->make([
            'body' => $this->body,
            'user_id' => Auth::id(),
        ]);
        $reply->commentable()->associate($comment->commentables);
        $reply->save();
        $this->reset('body');
        return $reply->load('user', 'replies.user', 'replies.replies'); // Return reply with relations
    }
}