<?php

namespace CodeWithRen\LaraCommentify;

use CodeWithRen\LaraCommentify\Livewire\Comments;
use CodeWithRen\LaraCommentify\Models\Comment;
use CodeWithRen\LaraCommentify\Policies\CommentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Livewire\Livewire;

class LaraCommentifyProvider extends ServiceProvider
{
    protected $policies = [
        Comment::class => CommentPolicy::class,
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
      
        // parent::registerPolicies();
      
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laracommentify');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/laracommentify'),
        ], 'views');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

         // Register Livewire components
    Livewire::component('comments', Comments::class);
    Livewire::component('single-comment', \CodeWithRen\LaraCommentify\Livewire\SingleComment::class);
    Livewire::component('like-comment', \CodeWithRen\LaraCommentify\Livewire\LikeComment::class);
        // $this->registerPolicies();
        // Now this works, no error:
       
    }
}
