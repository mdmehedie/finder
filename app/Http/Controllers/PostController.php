<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    // public function index()
    // {
    //     $posts = Post::with('user')->paginate(5);
    //     return view('posts.index', ['posts' => $posts]);
    // }
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

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect(route('posts.index'));
    }

    public function edit(Post $post)
    {
        if (!Gate::allows('isSuperAdmin', $post)) {
            abort(403);
        }
        //
    }

    public function update(Request $request, Post $post)
    {
        if (!Gate::allows('isSuperAdmin', $post)) {
            abort(403);
        }
        //
        $request->validate([
            'title' => 'required|string|max:155',
            'description' => 'required',
        ]);

        $updatepost = $post->update([
            'title' => $request->get('title'),
            'description' => $request->get('description')
        ]);

        if($updatepost == !null){
            return redirect(route('posts.index'))->with('status','Updated Complete');
        }else{
            return redirect(route('posts.index'))->withErrors(['message' => 'Can not update.']);
        }
    }
}
