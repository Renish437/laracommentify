<?php

namespace CodeWithRen\LaraCommentify\Models;

// use CodeWithRen\LaraCommentify\Models\Presenters\CommentPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'body',
        'user_id',
    ];
    public function commentable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
  
    public function isReply(){
        return isset($this->parent_id);
    }
    public function scopeParent(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }
    public function likes()
{
    return $this->hasMany(CommentLike::class);
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
