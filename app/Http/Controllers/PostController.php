<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->paginate(5);

        return view('posts.index', ['posts' => $posts, 'search' => $search]);
    }


    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required',
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect(route('posts.index'))->with('status', 'Post created successfully.');
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect(route('posts.index'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
    
        return view('posts.edit', ['post' => $post]);
        dd($post);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required',
        ]);

        $post->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ]);

        return redirect(route('posts.index'))->with('status', 'Post updated successfully');
    }
}
