<x-guest-layout>
    <div>
        @foreach($posts as $post)
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->body }}</p>
        @endforeach
    </div>
</x-guest-layout>
