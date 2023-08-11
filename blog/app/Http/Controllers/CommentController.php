<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post)
    {
        request()->validate([
            'content' => 'required|min:5'
        ]);

        $comment = new Comment();
        $comment->content = request('content');
        $comment->user_id = auth()->user()->id;

        // Save the comment and associate it with the post
        $post->comments()->save($comment);

        return redirect()->route('posts.show', $post);
    }

    public function edit(Comment $comment)
    {
        // Only the authenticated user who owns the comment can edit it
        if ($comment->user_id === auth()->user()->id) {
            return view('comments.edit', compact('comment'));
        }

        // If the user is not authorized to edit the comment, redirect back with an error
        return back()->withErrors('You are not authorized to edit this comment.');
    }

    public function update(Request $request, Comment $comment)
    {
        // Only the authenticated user who owns the comment can update it
        if ($comment->user_id === auth()->user()->id) {
            $request->validate([
                'content' => 'required|min:5',
            ]);

            $comment->update(['content' => $request->content]);

            return redirect()->route('posts.show', $comment->post);
        }

        // If the user is not authorized to update the comment, redirect back with an error
        return back()->withErrors('You are not authorized to update this comment.');
    }

    public function destroy(Comment $comment)
    {
        // Only the authenticated user who owns the comment can delete it
        if ($comment->user_id === auth()->user()->id) {
            $comment->delete();

            return redirect()->route('posts.show', $comment->post);
        }

        // If the user is not authorized to delete the comment, redirect back with an error
        return back()->withErrors('You are not authorized to delete this comment.');
    }
}
