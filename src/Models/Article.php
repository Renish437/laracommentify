<?php

namespace CodeWithRen\LaraCommentify\Models;

use Illuminate\Database\Eloquent\Model;
use CodeWithRen\LaraCommentify\Traits\Commentable;

class Article extends Model
{
    use Commentable;
    //
    protected $fillable = ['title', 'slug'];

     public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
