# LaraCommentify

A reusable comment system for Laravel 12 and Livewire 3. Built for rapid development and clean architecture.

## 📦 Installation


    composer require codewithren/laracommentify:dev-main

Or, in your composer.json:

    "minimum-stability": "dev",
    "prefer-stable": true

⚙️ Setup

Publish views (optional):

    php artisan vendor:publish --tag=views     --provider="CodeWithRen\LaraCommentify\LaraCommentifyProvider"

Run migrations (if any):

    php artisan migrate

🧩 Usage

In your Blade view:

    <livewire:comments :model="$post" />

Make sure your model uses the HasComments trait (if defined).
🛠 Components

    <livewire:comments /> — Displays comments

    <livewire:single-comment /> — Renders one comment with replies

    <livewire:like-comment /> — Like/unlike a comment

🧪 Test

To check the package, visit:

http://localhost:8000/commentify/test

📁 Directory Structure

packages/
└── CodeWithRen/
    └── LaraCommentify/
        ├── src/
        ├── routes/
        │   └── web.php
        ├── resources/
        │   └── views/
        │       ├── livewire/
        │       │   ├── comments.blade.php
        │       │   ├── like-comment.blade.php
        │       │   └── single-comment.blade.php