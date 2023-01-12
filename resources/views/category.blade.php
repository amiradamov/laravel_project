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
    {{-- <h1>{{$order->pivot['no_of_serving']}}</h1> --}}
    @forelse ($order->item as $item)
        <ul>
            <li class="inline italic text-gray-600 px-1 py-6">
                {{$item->pivot['no_of_serving']}}
            </li>
        </ul>
        
    @empty
        <p>No records</p>
    @endforelse

@endsection
