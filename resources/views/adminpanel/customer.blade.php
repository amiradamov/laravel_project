@extends('layouts.app')
@section('content')

<h1>{{$customer->customer_first_name}} {{$customer->customer_last_name}}</h1>

<hr>

<table class="table table-dark">
    <tr>
        <th>Order id</th>
        <th>Proccessed By</th>
        <th>Created at</th>
        <th></th>
    </tr>

    @forelse ($customer->user as $user)
    <tr>
        <td>{{$user->pivot['id']}}</td>
        <td>{{$user['name']}}</td>
        <td>{{$user->pivot['created_at']}}</td>
        <td>
            <a href="{{ URL::to('order/'.$user->pivot['id']) }}">View</a>
        </td>
    </tr>
    @empty
        
    @endforelse
</table>
@endsection
