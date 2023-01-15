@extends('layouts.app')
@section('content')

<h1>{{$customer->user['name']}} {{$customer->customer_last_name}}</h1>
{{-- <h2>{{$orders->id}}</h2> --}}
<table class="table table-dark">
    <tr>
        <th>Order id</th>
    </tr>
    @forelse ($customer->user as $user)
    <tr>
        <td>{{$user['name']}}</td>
        {{-- <td>{{$user->pivot['']}}</td> --}}
        {{-- <td>{{$order->proccessed_by}}</td> --}}
        {{-- <td>{{$order->proccessed_by}}</td> --}}
    </tr>
    @empty
        
    @endforelse
</table>
@endsection
