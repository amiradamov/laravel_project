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
                <th>
                    <a href="logout">Logout</a>
                    <form action="{{route('setting-user')}}" method="GET">
                        {{-- @csrf --}}
                        @if (Session("success"))
                            <div class="alert alert-success">
                                {{session("success")}}
                            </div>   
                        @endif
                        @if (Session("fail"))
                            <div class="alert alert-danger">
                                {{session("fail")}}
                            </div>
                        @endif
                        <button name="delete" value="True">Delete</button>
                    </form>
                </th>
            </tbody>
        </table>
    </div>
@endsection
