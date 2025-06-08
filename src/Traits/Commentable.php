<?php

namespace CodeWithRen\LaraCommentify\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use CodeWithRen\LaraCommentify\Models\Comment;

trait Commentable
{

    /**
     * @return MorphMany
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}