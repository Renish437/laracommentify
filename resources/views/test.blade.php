<x-app-layout>
    <h1>{{ $article->title }}</h1>
    

    <livewire:comments :model="$article" />
</x-app-layout>
