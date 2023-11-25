@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ Auth::user()->name }}</h3>
    <hr>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">All Posts</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->description }}</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-info">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
