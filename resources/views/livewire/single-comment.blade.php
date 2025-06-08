<div class="border-b py-4" x-data="{
    isReplying: @entangle('isReplying'),
    isEditing: @entangle('isEditing').live,
    openReplies: false
}"
    x-effect="if(isReplying){
    $nextTick(() => { $refs.replyForm.focus() })
    };
    if(isEditing){
    $nextTick(() => { $refs.updateForm.focus() })
    };
    
    "
    x-init="$wire.on('update-textarea', () => { $nextTick(() => { /* Ensure DOM is updated */ }) })">
    <div class="flex items-start space-x-3">
        <div class="w-10 h-10 rounded-full text-white flex items-center justify-center">
            <img class="w-10 h-10 rounded-full" src="{{ $comment->user->avatar() }}" alt="">
        </div>
        <div class="flex-1">
            <div class="flex justify-between">
                <div>
                    <span class="font-semibold">{{ $comment->user->name }}</span>
                    <span class="text-gray-500 text-sm ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
               
                <div x-data="{ open: false }" class="relative">
                    <!-- Three-dot (More) Icon -->
                   @if(!$comment->parent_id || auth()->user()->can('update', $comment))
                     <button @click="open = !open" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v.01M12 12v.01M12 18v.01"></path>
                        </svg>
                    </button>
                   @endif
                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-10">
                        <div class="py-1">
                            @if (!$comment->parent_id)
                                <button @click="isReplying = !isReplying; open = false"
                                    class="flex w-full text-left px-4 py-2 gap-1 text-sm text-gray-700 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-message-reply">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                                        <path d="M11 8l-3 3l3 3" />
                                        <path d="M16 11h-8" />
                                    </svg>
                                    <div> Reply</div>
                                </button>
                            @endif
                            @can('update', $comment)
                                <button @click="isEditing = !isEditing; open = false"
                                    class="flex w-full text-left px-4 py-2 gap-1 text-sm text-gray-700 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M20.548 3.452a1.542 1.542 0 0 1 0 2.182l-7.636 7.636-3.273 1.091 1.091-3.273 7.636-7.636a1.542 1.542 0 0 1 2.182 0zM4 21h15a1 1 0 0 0 1-1v-8a1 1 0 0 0-2 0v7H5V6h7a1 1 0 0 0 0-2H4a1 1 0 0 0-1 1v15a1 1 0 0 0 1 1z" />
                                    </svg>
                                    <div>Edit</div>
                                </button>
                            @endcan
                            @can('delete', $comment)
                                <button wire:confirm="Are you sure you want to delete this comment?"
                                    wire:click="$dispatch('deleteComment',{comment: {{ $comment->id }}})"
                                    class="flex w-full text-left px-4 gap-1 py-2 text-sm  hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M22 5a1 1 0 0 1-1 1H3a1 1 0 0 1 0-2h5V3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v1h5a1 1 0 0 1 1 1zM4.934 21.071 4 8h16l-.934 13.071a1 1 0 0 1-1 .929H5.931a1 1 0 0 1-.997-.929zM15 18a1 1 0 0 0 2 0v-6a1 1 0 0 0-2 0zm-4 0a1 1 0 0 0 2 0v-6a1 1 0 0 0-2 0zm-4 0a1 1 0 0 0 2 0v-6a1 1 0 0 0-2 0z" />
                                    </svg>
                                    <div> Delete</div>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
             

            </div>
            <p x-show="!isEditing" class="text-gray-700 mt-1">{{ $comment->body }}</p>
            <div class="flex gap-10">
                <div class="flex items-center gap-1">
                    <livewire:like-comment :comment="$comment" :key="$comment->id" />
                    {{-- Liked Filled below --}}


                </div>
                <div>
                    @if (!$comment->parent_id && $comment->replies->count() > 0)
                        <button type="button" class="text-gray-500 hover:underline"
                            @click="openReplies = !openReplies">View all replies</button>
                    @endif
                </div>
            </div>

            <!-- Reply Form -->
            <form wire:submit.prevent="addReply" wire:keydown.enter="addReply" x-cloak x-show="isReplying"
                class="mt-4" x-transition>
                <textarea x-ref="replyForm" wire:model="form.body"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"
                    placeholder="Write a reply..."></textarea>
                @error('form.body')
                    <p class="text-red-500 mt-2 text-xs">{{ $message }}</p>
                @enderror
                <div class="flex justify-end space-x-2 mt-2">
                    <button type="button" class="text-gray-500  bg-transparent border border-gray-500 px-4 py-2 rounded-lg"
                        @click="isReplying = false">Cancel</button>
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Post Reply</button>
                </div>
            </form>
            <!-- End Reply Form -->

            <!-- Update Form -->
            <form wire:submit.prevent="updateComment" x-cloak x-show="isEditing" class="mt-4" x-transition>

                <textarea x-ref="updateForm" wire:model="updateBody"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"
                    placeholder="Update your comment..."></textarea>
                @error('updateBody')
                    <p class="text-red-500 mt-2 text-xs">{{ $message }}</p>
                @enderror
                <div class="flex justify-end space-x-2 mt-2">
                    <button type="button" class="text-gray-500  bg-transparent border border-gray-500 px-4 py-2 rounded-lg"
                        @click="isEditing = false">Cancel</button>
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Update</button>
                </div>
            </form>
            <!-- End Update Form -->

            <!-- Replies -->
            <div x-show="openReplies">
                @foreach ($comment->replies as $key => $reply)
                    <livewire:single-comment :comment="$reply" :key="$reply->id" />
                @endforeach
            </div>
        </div>
    </div>
</div>
