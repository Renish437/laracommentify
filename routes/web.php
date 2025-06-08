<?php 

use Illuminate\Support\Facades\Route;
use App\Models\Article; // Or your commentable model
use CodeWithRen\LaraCommentify\Livewire\Comments;
use CodeWithRen\LaraCommentify\Models\Article as ModelsArticle;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/articles/{article:slug}', function (ModelsArticle $article) {
//         dd($article);
//         return view('articles.comments', ['article' => $article]);
//     })->name('articles.show');
// });

