
@extends('layouts.app')
@section('content')
    <section class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Join Date</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Validation Date</th>
                <th scope="col">Active</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">1</th>
                    <td>{{date('d-m-y', strtotime($user->created_at))}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->activationDate ? date('d M, y', strtotime($user->activationDate)) : '--' }}</td>
                    <td>{{$user->isActive ? 'Active' : 'Inactive'}}</td>
                    @can('isAdmin')
                    <td class="d-flex">
                        <a href="{{route('dashboard.user.edit', $user->id)}}" class="btn btn-sm btn-outline-dark" style="margin-right: 10px">Edit </a>
                        <form method="POST" action="{{ route('dashboard.user.delete', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="ml-2 btn btn-sm btn-outline-danger">Delete </button>
                        </form>
                    </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="d-flex justify-content-end align-items-center">
                <div class="pagination ml-2">
                    <span>Showing {{ $users->currentPage() }} of {{ $users->lastPage() }}</span>
                </div>
                @if ($users->previousPageUrl())
                    <a href="{{ $users->previousPageUrl() }}" rel="prev" class="btn btn-primary mx-2">&laquo;
                        Previous</a>
                @else
                    <span class="btn btn-secondary disabled mx-2">&laquo; Previous</span>
                @endif
                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <a href="{{ $users->url($i) }}"
                       class="btn btn-outline-primary mx-2 {{ ($users->currentPage() == $i) ? 'active' : '' }}">{{ $i }}</a>
                @endfor

                @if ($users->nextPageUrl())
                    <a href="{{ $users->nextPageUrl() }}" rel="next" class="btn btn-primary mx-2">Next &raquo;</a>
                @else
                    <span class="btn btn-secondary disabled mx-2">Next &raquo;</span>
                @endif
            </div>
        </div>
    </section>
@endsection




