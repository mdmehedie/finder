
@extends('layouts.app')
@section('content')
    <section class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
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
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->activationDate}}</td>
                    <td>{{$user->isActive ? 'Active' : 'Inactive'}}</td>
                    <td><a href="{{route('dashboard.user.edit', $user->id)}}" class="btn btn-sm btn-outline-dark">Edit </a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection



