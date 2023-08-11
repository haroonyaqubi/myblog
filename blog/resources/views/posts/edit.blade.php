@extends("layouts.post")
@section("title", "Editer un post")
@section("content")

		<div class="bg-white p-8 max-w-full mx-auto rounded-lg shadow-md">
			<h1 class="bg-gray-50 text-gray-700 py-2 px-4 font-bold text-xl uppercase border-b border-gray-200">Ajouter un post</h1>
			<!-- Si nous avons un Post $post -->
			@if (isset($post))
			<!-- Le formulaire est géré par la route "posts.update" -->
			<form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
				@method('PUT')
			@else
			<!-- Le formulaire est géré par la route "posts.store" -->
			<form class="bg-gray-50 text-gray-700 py-2 px-4 font-bold text-xl uppercase border-b border-gray-200" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
			@endif

				<!-- Le token CSRF -->
				@csrf

				<div class="mb-4">
					<label for="title" class="block text-sm font-bold">Titre</label>
					<input type="text" name="title" value="{{ isset($post->title) ? $post->title : old('title') }}" id="title" placeholder="Le titre du post" class="w-full px-3 py-2 mt-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500 @error('title') border-red-500 @enderror">
					<!-- Le message d'erreur pour "title" -->
					@error("title")
					<div class="text-red-500 text-sm">{{ $message }}</div>
					@enderror
				</div>

				<!-- S'il y a une image $post->picture, on l'affiche -->
				@if(isset($post->picture))
				<div class="mb-4">
					<span class="block font-bold italic text-gray-500">Couverture actuelle</span>
					<img src="{{ asset('storage/'.$post->picture) }}" alt="image de couverture actuelle" style="max-height: 200px;">
				</div>
				@endif

				<div class="mb-4">
					<input type="file" name="picture" id="picture" class="w-full px-3 py-2 mt-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500 @error('picture') border-red-500 @enderror">
					<!-- Le message d'erreur pour "picture" -->
					@error("picture")
					<div class="text-red-500 text-sm">{{ $message }}</div>
					@enderror
				</div>
				<div class="mb-4">
					<label for="content" class="block text-sm font-bold">	</label>
					<textarea name="content" id="content" lang="fr" rows="10" placeholder="Le contenu du post" class="w-full px-3 py-2 mt-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500 @error('content') border-red-500 @enderror">{{ isset($post->content) ? $post->content : old('content') }}</textarea>
					<!-- Le message d'erreur pour "content" -->
					@error("content")
					<div class="text-red-500 text-sm">{{ $message }}</div>
					@enderror
				</div>
				<button type="submit" class="bg-gray-500 text-white text-xs font-extrabold py-3 px-5 rounded-3xl">Valider</button>
			</form>
		</div>
@endsection