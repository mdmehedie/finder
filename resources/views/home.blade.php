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

                    <div class="row mb-3">
                        <div class="col">
                            @can('isSuperAdmin')
                                <div class="alert alert-info" role="alert">
                                    Supper Admin can access.
                                </div>
                            @endcan
                        </div>
                        <div class="col">
                            @can('isAdmin')
                                <div class="alert alert-info" role="alert">
                                    Admin can access.
                                </div>
                            @endcan
                        </div>
                        <div class="col">
                            @can('isUser')
                                <div class="alert alert-info" role="alert">
                                    User can access.
                                </div>
                            @endcan
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('posts.index') }}" class="btn btn-info">View Posts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
