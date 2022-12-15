@extends('layouts.app')
@section('content')
    <h4>Registration</h4>
    <form action="{{route('register-user')}}" method="POST">
        @if (Session("success"))
            <div class="alert alert-success">
                {{session("success")}}
            </div>   
        @endif
        @if (Session("fail"))
            <div class="alert alert-fail">
                {{session("fail")}}
            </div>
        @endif
        @csrf
        <label for="name">Full Name</label>
        <input type="text" class="form-control" name="name" value="" autocomplete="off">
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

    <a href="login">Already have an account? Login.</a>
@endsection

@section('name')
@endsection