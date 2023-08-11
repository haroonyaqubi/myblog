<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    //Afficher la page d'accueil avec une liste d'articles
public function welcome()
{
    $posts = Post::all();
    return view('welcome', compact('posts'));
}

    //Afficher un list de tous les messages
    public function index()
    {
        $posts = Post::latest()->get();
        return view("posts.index", compact("posts"));
    }

     //Afficher le formulaire de création d'un nouveau message
    public function create()
    {
        return view("posts.edit");
    }

    // Stocker un message nouvellement crée 
    public function store(Request $request)
    {
        // 1. La validation et logique de création de messages
        $validated = $request->validate([
            'title' => 'bail|required|string|max:255',
            "picture" => 'bail|required|image|max:1024',
            "content" => 'bail|required',
        ]);
        $chemin_image = $request->picture->store("posts");
        $validated['picture'] = $chemin_image;
        $request->user()->posts()->create($validated);


        // 4. On retourne vers tous les posts : route("posts.index")
        return redirect(route("posts.index"));
        $data = request()->validate([
            'body' => 'required'
        ]);
    }
    
    //Afficher les détails d'un messages spécifique
    public function show(Post $post)
    {
        return view("posts.show", compact("post"));
    }



   //Afficher le formualier de modification d'un message
    public function edit(Post $post)
    {
        return view("posts.edit", compact("post"));
    }

    //Mise a jour d'un messages
    public function update(Request $request, Post $post)
    {
        // Validation et logique de post-mise a jour
        $rules = [
            'title' => 'bail|required|string|max:255',
            "content" => 'bail|required',
        ];
        if ($request->has("picture")) {
            $rules["picture"] = 'bail|required|image|max:1024';
        }
        $this->validate($request, $rules);
        if ($request->has("picture")) {
            Storage::delete($post->picture);
            $chemin_image = $request->picture->store("posts");
        }
        // On met à jour les informations du Post
        $post->update([
            "title" => $request->title,
            "picture" => isset($chemin_image) ? $chemin_image : $post->picture,
            "content" => $request->content
        ]);
        // On affiche le Post modifié : route("posts.show")
        return redirect(route("posts.show", $post));
    }



    //Supprimer un message
    public function destroy(Post $post)
    {
        // On supprime l'image existant
        Storage::delete($post->picture);
        $post->delete();
        return redirect(route('posts.index'));
    }
}


