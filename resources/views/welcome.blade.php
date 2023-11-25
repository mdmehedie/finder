<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Home</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Your Custom Styles -->
    <style>
        /* Add your custom styles here if needed */
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <!-- Blog Logo or Image -->
                <img src="{{ asset('assets/blog-home.jpg') }}" alt="Blog Logo" class="img-fluid mb-3">

                <!-- Blog Title -->
                <h1 class="font-weight-bold mb-4">Welcome to Our Blog</h1>

                <!-- Navigation Links -->
                @if (Route::has('login'))
                <div class="text-center">
                    @auth
                    <a href="{{ url('/home') }}" class="btn btn-primary btn-lg">Home</a>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-secondary btn-lg">Log in</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg ml-2">Register</a>
                    @endif
                    @endauth
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
