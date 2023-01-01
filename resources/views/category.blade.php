@extends('layouts.app')
@section('content')
    <h1>{{$category->category_name}}</h1>
    @forelse ($category->item as $item)
        <ul>
            <li class="inline italic text-gray-600 px-1 py-6">
                {{$item['item_name']}}
            </li>
        </ul>
        
    @empty
        
    @endforelse
@endsection
