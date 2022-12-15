@extends('layouts.app')
@section('content')
    <h1>hello</h1>
    <form action="{{route('login-user')}}" method="POST">
        @csrf
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
        <label for="name">Email</label>
        <input type="text" class="form-control" name="email" value="" autocomplete="off">
        <label for="name">Password</label>
        <input type="password" class="form-control" name="password" value="" autocomplete="off">
        <input type="submit">

        @if(count($errors))
            <div class="form-group">
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </form>
    <a href="registration">New user !! Register Here.</a>
@endsection

@section('name')
@endsection