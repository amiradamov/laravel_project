@extends('layouts.app')
@section('body')
<h2 class="display-4 text-white">Create Order for {{$customer->customer_first_name}} {{$customer->customer_last_name}}</h2>
<hr  style=" background-color:#ffffff">

<div class="editadmin"> 
        {{-- Search --}}
        <div class="container">
          <form action="">
            <div class="row mb-5 py-1 form-group " style="background-color: #D9D9D9; border-radius: 12px; "> 
              <div class="py-1 w-25 ml-3">
                <input type="search" name="search" id="" value="{{$search}}" class="form-control w-100  pr-6" placeholder="Search by name or email" style="border-radius: 12px;">
              </div>
              <div class="col py-1" >
                <button class="btn" style="background-color:#494949; color: white; border-radius: 12px;">
                  Search
                </button>
                <a href="{{url('admin/customers')}}">
                  <button class="btn" type="button" style="background-color:#494949; color: white; border-radius: 12px;">
                    Reset
                  </button>
                </a>
              </div>
              <div class="col py-1 d-flex justify-content-end">
                <a href="{{url('admin/'.$data->id.'/create/customer')}}">
                  <button class="btn" type="button" style="background-color:#494949; color: white; border-radius: 12px;">
                    Create New Profile
                  </button>
                </a>
              </div>
            </div>
          </form>
        </div>

      {{-- Items --}}
      <div class="row">
        @forelse ($items as $item)
        <div class="col-md-4 mb-4">
          <div class="card">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">{{$item->item_name}}</h5>
              <p class="card-text">{{ Str::limit($item->item_description, 200) }}</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
        @empty
            
        @endforelse
      </div>
</div>
@endsection