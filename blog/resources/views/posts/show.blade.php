
@extends("layouts.post")

@section("title", $post->title)

@section("content")
    <div class="flex flex-row justify-center">
        <div class="border border-gray-300 rounded-lg p-4">
            <h1 class="text-xl font-bold uppercase">{{ $post->title }}</h1>
            <img src="{{ asset('storage/'.$post->picture) }}" alt="Image de couverture" style="max-width: 300px;">
            <div class="mt-4 mb-4">{{ $post->content }}</div>
        </div>
    </div>
    
    <!-- New Comment Form -->
    @auth
    <div class="flex flex-row justify-center mt-4">
        <div class="border border-gray-300 rounded-lg p-4 w-full">
            <form action="{{ route('comments.store', $post) }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="content" class="block font-bold mb-2">Ajouter un commentaire :</label>
                    <input type="text" name="content" id="content" class="w-full border rounded-lg focus:outline-none focus:border-blue-500">
                    @error('content')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="border rounded-lg focus:outline-none focus:border-blue-500">Envoyer le commentaire</button>
                </div>
            </form>
        </div>
    </div>
    @endauth

    <!-- Comments -->
    <div class="flex flex-row justify-center mt-4">
        <div class="border border-gray-300 rounded-lg p-4 w-full">
            <h2 class="text-lg font-bold mt-4 mb-2">Commentaires :</h2>
            @if ($post->comments->count() > 0)
                @foreach ($post->comments as $comment)
                    <div class="border border-gray-300 rounded-lg p-4 mt-2 flex justify-between items-center">
                        <div>
                            <p>{{ $comment->content }}</p>
                            <p>Commented by: {{ $comment->user->name }}</p>
                        </div>
                        @if (auth()->check() && $comment->user_id === auth()->user()->id)
                            <div class="flex flex-col md:flex-row">
                                <a href="{{ route('comments.edit', $comment) }}" class="bg-blue-500 text-white py-2 px-6 rounded-lg md:mr-2 mb-2 md:mb-0">Modifier</a>
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white py-2 px-4 mt-3 rounded-lg">Supprimer</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <p>Aucun commentaire pour l'instant.</p>
            @endif
        </div>
    </div>
    @endsection
