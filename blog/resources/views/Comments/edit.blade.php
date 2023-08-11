@extends('layouts.post')

@section('title', 'Edit Comment')

@section('content')
    <div class="flex flex-row justify-center mt-4">
        <div class="border border-gray-300 rounded-lg p-4 w-full">
            <form action="{{ route('comments.update', $comment) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="content" class="block font-bold mb-2">Modifiez votre commentaire :</label>
                    <input type="text" name="content" id="content" class="w-full border rounded-lg focus:outline-none focus:border-blue-500" value="{{ $comment->content }}">
                    @error('content')
                        <p class="text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="border rounded-lg focus:outline-none focus:border-blue-500 py-2 px-4">Mise à jour des commentaires</button>
                </div>
            </form>
        </div>
    </div>
@endsection


