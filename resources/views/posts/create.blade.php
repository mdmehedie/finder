@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Create a New Post</h3>
    <hr>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <!-- Add any other fields you need for your Post model -->

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>

    <a href="{{ route('posts.index') }}" class="btn btn-info mt-3">Go Back</a>
</div>
@endsection
