@extends("layouts.post")
@section("title", "Tous les articles")
@section("content")

@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="bg-black text-gray-700 py-2 px-4 font-bold text-xl uppercase border-b border-gray-200 ">
	<h1>Tous les articles</h1>
	<p>
		<!-- Lien pour créer un nouvel article : "posts.create" -->
		<a href="{{ route('posts.create') }}" title="Créer un article" >Créer un nouveau post</a>
	</p> 
</div>
<div class="flex flex-row border-b border-gray-200">
	<!-- Le tableau pour lister les articles/posts -->
	<table border="1" >
		<thead>
			<tr>
				<th>Titre</th>
				<th colspan="2" >Opérations</th>
			</tr>
		</thead>
		<tbody>
			<!-- On parcourt la collection de Post -->
			<div class="m-auto sm:m-auto text-left w-4/5 block">
			@foreach ($posts as $post)

			<div class="m-auto sm:m-auto text-left w-4/5 block">
				<a href="{{ route('posts.show', $post) }}" title="Lire l'article" class="inline"><img class="rounded-xl w-64 h-64 object-contain m-2 mr-5" class="w-44" src="{{ asset('storage/'.$post->picture) }}"></a>
				<a href="{{ route('posts.show', $post) }}" title="Lire l'article" class="inline font-bold text-center text-2xl mr-5 mt-5" style="margin-top : 1vh; margin-bottom: 1vh">{{ $post->title }}</a>
			</div>
			<div class="py-8 my-6 w-auto space-y-8 text-gray-500 text-s">
				<tr>
				<td>
					<!-- Lien pour afficher un Post : "posts.show" -->
					<a href="{{ route('posts.show', $post) }}" title="Lire l'article" class="uppercase bg-transparent border-2 border-gray-100 text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">{{ $post->title }}</a>
				</td>
				<td>
					<!-- Lien pour modifier un Post : "posts.edit" -->
					<a href="{{ route('posts.edit', $post) }}" title="Modifier l'article" class="uppercase bg-transparent border-2 border-gray-100 text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">Modifier</a>
				</td>
				<td>
					<!-- Formulaire pour supprimer un Post : "posts.destroy" -->
					<form method="POST" action="{{ route('posts.destroy', $post) }}" >
						<!-- CSRF token -->
						@csrf
						<!-- <input type="hidden" name="_method" value="DELETE"> -->
						@method("DELETE")
						<input type="submit" value="x Supprimer "class="bg-transparent block border-b-2 h-20 text-2xl outline-none" >
					</form>
				</td>
			@endforeach
		</div>
		</tbody>
	</table>
</div>
</div>
</div>
@endsection