@extends("layouts.post")
@section("title", "Tous les articles")
@section("content")

	
		<div class="bg-black text-gray-700 py-2 px-4 font-bold text-xl uppercase border-b border-gray-200 ">
			<h1>Tous les articles</h1>
			<p>
				<!-- Lien pour créer un nouvel article : "posts.create" -->
				<a href="{{ route('posts.create') }}" title="Créer un article" >Créer un nouveau post</a>
			</p> 
		</div>
			<div class="flex flex-row border-b border-gray-200 justify-center">
				<!-- Le tableau pour lister les articles/posts -->
				<div class="m-auto sm:m-auto text-left w-4/5 grid grid-cols-4 gap-4">
					@foreach ($posts as $post)
						<div class="border border-gray-300 rounded-lg">
							<div class="p-4">
								<a href="{{ route('posts.show', $post) }}" title="Lire l'article" class="block">
									<img class="rounded-xl w-64 h-64 object-contain m-2 mr-5" src="{{ asset('storage/'.$post->picture) }}">
								</a>
								<a href="{{ route('posts.show', $post) }}" title="Lire l'article" class="font-bold text-center text-2xl mt-5 ">{{ $post->title }}</a>
							</div>
							<div class="p-4 bg-gray-100">
								<div class="flex items-center space-x-4 pl-10">
									@auth
									@if ($post->user_id === auth()->user()->id)
										<div class="flex">
											<!-- Lien pour modifier un Post : "posts.edit" -->
											<a href="{{ route('posts.edit', $post) }}" title="Modifier l'article" class="bg-blue-500 text-white text-xs font-extrabold py-3 px-5 rounded-3xl">Modifier</a>
							
											<!-- Formulaire pour supprimer un Post : "posts.destroy" -->
											<form class="ml-4" method="POST" action="{{ route('posts.destroy', $post) }}">
												<!-- CSRF token -->
												@csrf
												<!-- <input type="hidden" name="_method" value="DELETE"> -->
												@method("DELETE")
												<button type="submit" class="bg-red-500 text-white text-xs font-extrabold py-3 px-5 rounded-3xl">Supprimer</button>
											</form>
										</div>
										@endif
									@endauth
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection