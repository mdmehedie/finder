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
                        <h4>Admin can access this portion (admin)</h4>
                    @endcan

                    @can('isAdmin')
                        <h4>User can access this portion (user)</h4>
                    @endcan

                    @can('isUser')
                        <h4>Editor can access this portion (editor)</h4>
                    @endcan

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
