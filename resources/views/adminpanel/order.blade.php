@extends('layouts.app')
@section('content')

<h1>Order #{{$order->id}}</h1>

<hr>

<table class="table table-dark">
    <tr>
        <th>Item name</th>
        <th>Item price</th>
        <th>Category</th>
        <th>no of serving</th>
    </tr>
    @forelse ($order->item as $item)
        <tr>
            <td>{{$item['item_name']}}</td>
            <td>{{$item['item_price']}}</td>
            <td>{{$item->category->category_name}}</td>
            <td>{{$item->pivot['no_of_serving']}}</td>
        </tr>
    @empty
        
    @endforelse
</table>

@endsection
