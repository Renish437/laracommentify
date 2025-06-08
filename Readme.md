## LaraCommentify

A reusable comment system for Laravel 12 and Livewire 3, built for rapid development and clean architecture.
📦 Installation

Install the package via Composer:

    composer require codewithren/laracommentify:dev-main --with-all-dependencies


If you encounter a stability error, update your composer.json:

    "minimum-stability": "dev",
    "prefer-stable": true

⚙️ Setup
1. Publish Views (Optional)

    php artisan vendor:publish --tag=views     --provider="CodeWithRen\LaraCommentify\LaraCommentifyProvider"

2. Run Migrations

    php artisan migrate

🧩 Usage

In your Blade view, include the comment component and pass in the commentable model (e.g., Post, Article, etc.):

    <livewire:comments :model="$post" />

Make sure your model uses the Commentable trait:

    use CodeWithRen\LaraCommentify\Traits\Commentable;

    class Post extends Model
    {
    use Commentable;
    }

🛠 Components
Component	Description
    <livewire:comments />	Displays all comments for a model
    <livewire:single-comment />	Renders a single comment with replies
    <livewire:like-comment />	Handles like/unlike functionality
✅ Requirements

    PHP 8.3+

    Laravel 12+

    Livewire 3+

👤 Author

Developed by Renish Siwakoti

GitHub: github.com/Renish437/laracommentify