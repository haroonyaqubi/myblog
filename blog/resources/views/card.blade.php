<div class="border border-gray-300 rounded-lg p-4">
    <h1 class="text-xl font-bold uppercase">{{ $post->title }}</h1>
    <img src="{{ asset('storage/'.$post->picture) }}" alt="Image de couverture" style="max-width: 100px;">
    <div class="mt-4 mb-4">{{ Str::limit($post->content, 200) }}</div>
    <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">En savoir plus</a>
</div>