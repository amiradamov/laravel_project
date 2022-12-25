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
                        @csrf
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
                        <button name="edit" value="user-edit">Edit</button>

                        @if (Session("EditUser"))
                            <table>
                                <thead>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                </thead>
                                <tbody>
                                    <th><input type="text" class="col-auto" autocomplete="off" value="" name="name"></th>
                                    <th><input type="text" class="col-auto" autocomplete="off" value="" name="email"></th>
                                    <th><input type="password" class="col-auto" autocomplete="off" value="" name="password"></th>
                                </tbody>
                                <br>
                                <tbody>
                                    <th>
                                        <button name="cancel" value="user-cancel">Cancel</button>
                                        <button name="submit" value="user-submit">Submit</button> 
                                    </th>
                                </tbody>
                            </table>
                        @endif
                    </form>
                </th>
            </tbody>
        </table>
    </div>
@endsection
