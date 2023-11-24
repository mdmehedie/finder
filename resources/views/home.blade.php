@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @can('isSuperAdmin')
                        <h4>Supper Admin can access.</h4>
                    @endcan

                    @can('isAdmin')
                        <h4>Admin can access.</h4>
                    @endcan

                    @can('isUser')
                        <h4>User can access.</h4>
                    @endcan

                    <a href="{{ route('posts.index') }}" class="btn btn-sm btn-success">Posts</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
