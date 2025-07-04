<?php

namespace CodeWithRen\LaraCommentify\Models;
use CodeWithRen\LaraCommentify\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    //
    protected $fillable = [
        'user_id',
        'comment_id',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}

public function comment()
{
    return $this->belongsTo(Comment::class);
}

}
