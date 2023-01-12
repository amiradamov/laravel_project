@extends('layouts.app')
@section('content')
    {{-- <h1>{{$category->category_name}}</h1>
    @forelse ($category->item as $item)
        <ul>
            <li class="inline italic text-gray-600 px-1 py-6">
                {{$item['item_name']}}
            </li>
        </ul>
        
    @empty  
    @endforelse --}}
    <br>
    <h1>{{$item->item_name}}</h1>
    @forelse ($item->customer as $customer)
        <ul>
            <li class="inline italic text-gray-600 px-1 py-6">
                {{$customer->pivot['score']}}
            </li>
            <li class="inline italic text-gray-600 px-1 py-6">
                {{$customer->pivot['comments']}}
            </li>
            <li class="inline italic text-gray-600 px-1 py-6">
                {{$customer['customer_first_name']}} {{$customer['customer_last_name']}} 
            </li>
        </ul>
        
    @empty
        <p>No records</p>
    @endforelse

@endsection
