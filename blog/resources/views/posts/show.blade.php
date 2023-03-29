@extends("layouts.post")
@section("title", $post->title)
@section("content")
@vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="bg-black text-gray-700 py-2 px-4 font-bold text-xl uppercase border-b border-gray-200 ">
	<h1>{{ $post->title }}</h1>

	<img src="{{ asset('storage/'.$post->picture) }}" alt="Image de couverture" style="max-width: 300px;">

	<div>{{ $post->content }}</div>
	<h2>Commentaires</h2>

	@if (is_array($post->comments) || is_object($post->comments))
	@forelse ($post->comments as $comment)
	// Do something with $comment
	@empty
	@endforelse
	@else
	@endif

    {{-- @forelse ($post->comments as $comment) --}}
    <div class="card">
        <div class="card-body">
            {{-- {{ $comments->content }} --}}
        </div>
    </div>
            {{-- @empty --}}
                {{-- <div class="alert alert-info">Aucun commentaire pour cet article</div> --}}
            {{-- @endforelse --}}
    {{-- <form action="{{ route('comments.store', $post->id) }}" method="POST" class="flex flex-col  rounded-lg p-4">
    @csrf
        <div class="form-group mb-3">
            <label for="content">Votre commentaire</label>
            <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Soumettre mon commentaire</button>
    </form>
    <div class="buttons mt-3">
        <a href="{{ route('posts.edit', $post) }}" class="btn btn-info">Modifier</a>
        <form action="{{ url('posts/'. $post->id) }}" method="POST" style="display: inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form> --}}

	<p><a href="{{ route('posts.index') }}" title="Retourner aux articles" >Retourner aux posts</a></p>
@endsection
</div>
