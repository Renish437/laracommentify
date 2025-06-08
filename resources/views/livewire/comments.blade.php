
    <section  class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 mb-4">

        <!-- Comment Form -->
        <form wire:submit.prevent="postComment" wire:keydown.enter="postComment" x-cloak class="mt-6">
            <h3 class="text-lg font-semibold mb-2">Leave a Comment</h3>
            <textarea wire:model="form.body" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Write a comment..."></textarea>
            @error('form.body')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <button type="submit"  class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Post Comment</button>
        </form>

        <h1 class="text-2xl font-bold mb-4 mt-10">Comments ({{ $comments->total() }})</h1>
        
        <!-- Comments List -->
        <div x-data="{ isReplying: false }">
           

            <!-- Comment 1 -->
          @forelse($comments as $key => $comment)
            <livewire:single-comment :comment="$comment" :key="$comment->id" />
          @empty
            <h2 class="text-gray-600 text-2xl text-center font-semibold">No comments Yet</h2>
          @endforelse
          <div>
            {{ $comments->links() }}
          </div>
        </div>

        
    </section>
