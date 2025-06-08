<?php

namespace CodeWithRen\LaraCommentify\Livewire\Forms;


use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;

use Livewire\Form;

class CommentForm extends Form
{
    //
   #[Rule('required',message:'Please enter a comment')]
    public $body;
    public function storeComment($model){
        $this->validate();
        $model->comments()->create([
            'body' => $this->body,
            'user_id' => Auth::id(),
        ]);

        $this->reset('body');
    }
}
