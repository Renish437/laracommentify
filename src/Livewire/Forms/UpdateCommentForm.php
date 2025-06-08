<?php

namespace CodeWithRen\LaraCommentify\Livewire\Forms;

use CodeWithRen\LaraCommentify\Models\Comment;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UpdateCommentForm extends Form
{
    #[Rule('required',message:'Please enter a comment')]
    public $body;

    public function updateComment(Comment $comment)
    {
        $this->validate();

        $comment->update([
            'body' => $this->body,
        ]);

        $this->reset('body');
    }
}