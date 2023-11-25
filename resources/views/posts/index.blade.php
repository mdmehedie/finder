@extends('layouts.app')

@section('content')
<div class="container">
  <form action="{{ route('posts.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ $search }}">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
</form>
<h3>{{ Auth::user()->name }}</h3>
<div class="row justify-content-between">
    <div class="col-md-4">
        <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">Add Post</a>
    </div>
</div>
<hr>
<div class="row justify-content-center">
    <div class="col-md-12">

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col" class="col-md-1">User</th>
                    <th class="col-md-2">Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($posts as $post)
                     <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->user->name }}</td> {{-- From the Post.php Model name is coming from --}}
                        <td>
                          @can('view', $post)  {{-- This view is coming from policy. --}}
                          <a href="{{ route('post.show', $post) }}" class="btn btn-sm btn-primary">View</a>
                          @endcan

                          @can('update', $post)  {{-- This update is coming from policy. --}}
                          <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-warning">Update</a>
                          @endcan

                          @can('delete', $post)  {{-- This delete is coming from policy. --}}
                          <a href="{{ route('post.delete', $post) }}" class="btn btn-sm btn-danger">Delete</a>
                          @endcan
                        </td>
                      </tr>
                    @endforeach

                </tbody>
              </table>

              <div class="d-flex justify-content-center">
                {{ $posts->appends(['search' => $search])->links() }}
              </div>

        </div>
    </div>
</div>
@endsection
