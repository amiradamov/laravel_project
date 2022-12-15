@extends('layouts.app')
@section('content')
    <div class="contianer">
        <h1>hello,  {{$data->name}}</h1>
        <hr>
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody>
                <th>{{$data->name}}</th>
                <th>{{$data->email}}</th>
                <th><a href="logout">Logout</a></th>
            </tbody>
        </table>
    </div>
@endsection
