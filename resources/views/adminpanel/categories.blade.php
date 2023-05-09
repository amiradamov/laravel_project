@extends('layouts.app')
@section('menu')

@endsection

@section('body')
    <style>
        .customer {
        background-color: #272727;
        }
    </style>

    <h2 class="display-4 text-white">Categories</h2>
    <hr  style=" background-color:#ffffff">

    {{-- Search --}}
    <form action="">
        <div class="row mb-5 py-1 form-group " style="background-color: #D9D9D9; border-radius: 12px; "> 
            <div class="py-1 w-25 ml-3">
            <input type="search" name="search" id="" value="{{$search}}" class="form-control w-100  pr-6" placeholder="Search by name or email" style="border-radius: 12px;">
            </div>
            <div class="col py-1" >
            <button class="btn" style="background-color:#494949; color: white; border-radius: 12px;">
                Search
            </button>
            <a href="{{url('admin/categories')}}">
                <button class="btn" type="button" style="background-color:#494949; color: white; border-radius: 12px;">
                Reset
                </button>
            </a>
            </div>
            <div class="col py-1 d-flex justify-content-end">
            <a href="{{url('admin/'.$data->id.'/create/category')}}">
                <button class="btn" type="button" style="background-color:#494949; color: white; border-radius: 12px;">
                Create New Category
                </button>
            </a>
            </div>
        </div>
    </form>

    {{-- Customers --}}
    @forelse ($categories as $category)
        <a href="{{ URL::to('admin/category/'.$category->id) }}" class="" style="font-size: 20px; color: white">
            <div class="row py-1 px-2 blonde mb-2" style="background-color: #565656; border-radius: 12px;">
            <div class="col-xm">
                <img src="{{ asset("/def_images/def_category.png") }}" alt="{{ $category->category_name }}" width="70" class="mr-3 rounded-circle img-thumbnail shadow-sm" style="background-color: white">
            </div>
            <div class="col-sm pt-4">
                {{$category->category_name}} 
            </div>
            <div class="col-sm pt-4">
                {{$category->description}}
            </div>
            <div class="col-sm pt-4 text-center">
                Status: @if ($category->category_status == 1)
                <b class="text-success">Active</b>
            @else
            <b class="text-danger">Deactivated</b>
            @endif
            </div>
            </div>
        </a>
        @empty    
    @endforelse
@endsection