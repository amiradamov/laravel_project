@extends('layouts.app')
@section('body')


<div class="container text-center">
        <figure class="figure">
            <img src="{{ asset("/def_images/def_category.png") }}" alt="{{$category->category_name}}" width="340" class="mr-3 rounded-circle img-thumbnail shadow-sm">

            <figcaption class="figure-caption text-center text-uppercase" style="font-size: 25px; color: white">{{$category->category_name}}</figcaption>
        </figure>
</div>

<div class="container text-center"> 
    {{-- <div class="col py-1" > --}}
      <a href="{{ URL::to('admin/category/'.$category->id.'/edit') }}">
        <button class="btn-lg" style="background-color:#494949; color: #FFC700; border-radius: 12px; border-width: 0">
          Edit Category
        </button>
      </a>
      <a href="{{url('admin/categories')}}">
        <button class="btn-lg" type="button" style="background-color:red; color: white; border-radius: 12px; border-width: 0">
          Delete Category
        </button>
      </a>
    {{-- </div> --}}
  </div>
<hr  style=" background-color:#ffffff">


<div class="row">
    <div class="col text-wrap">
        Description: {{$category->description}}
    </div>
    <div class="col active">
        Status: @if ($category->category_status == 1)
            <b class="text-success">Active</b>
        @else
        <b class="text-danger">Deactivated</b>
        
        @endif
    </div>
</div>

<br>

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
            <a href="{{url('admin/category/'.$category->id)}}">
              <button class="btn" type="button" style="background-color:#494949; color: white; border-radius: 12px;">
                Reset
              </button>
            </a>
          </div>
        </div>
    </form>

      {{-- Items --}}
      <div class="row">
        @forelse ($items as $item)
        <div class="col-md-4 mb-4">
          <div class="card">

            @if ($item->item_image != "")
                <img src="{{ asset("images/$item->item_image") }}"  class="card-img-top">
            @else
                <img src="{{ asset("/def_images/def_item_profile.png") }}" height="180" class="card-img-top" style="object-fit: cover;">
            @endif

            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{$item->item_name}}</h5>
              <p class="card-text">{{ Str::limit($item->item_description, 200) }}</p>
            </div>
          </div>
        </div>
        @empty
            
        @endforelse
@endsection