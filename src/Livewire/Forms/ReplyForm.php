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

    $reply = new Comment();
    $reply->body = $this->body;
    $reply->user_id = Auth::id();
    $reply->parent_id = $comment->id;

    // ✅ Inherit the commentable type and ID from the parent comment
    $reply->commentable_id = $comment->commentable_id;
    $reply->commentable_type = $comment->commentable_type;

    $reply->save();

    $this->reset('body');

    return $reply->load('user', 'replies.user', 'replies.replies');
}

}