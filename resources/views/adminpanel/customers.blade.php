@extends('layouts.app')
@section('menu')

@endsection

@section('body')
    <style>
      .customer {
        background-color: #272727;
      }
    </style>
      <h2 class="display-4 text-white">Customers</h2>
      <hr  style=" background-color:#ffffff">
      
      {{-- Search --}}
      <form action="">
          <div class="row mb-5 py-1 form-group " style="background-color: #D9D9D9; border-radius: 12px; "> 
            <div class="py-1 col-4">
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
      
      {{-- Customers --}}
      @forelse ($customers as $customer)
      <a href="{{ URL::to('admin/customer/'.$customer->id) }}" class="" style="font-size: 20px; color: white">
      <div class="row py-1 px-2 blonde mb-2" style="background-color: #565656; border-radius: 12px;">
        <div class="col-xm">
          @if ($customer->profile_image != "")
          <img src="{{ asset("images/$customer->profile_image") }}" alt="{{ $customer->customer_first_name }} {{ $customer->customer_last_name }}" width="70" class="mr-3 rounded-circle img-thumbnail shadow-sm" style="background-color: white">
        @else
          <img src="{{ asset("/def_images/def_customer_profile.png") }}" alt="{{ $customer->customer_first_name }} {{ $customer->customer_last_name }}" width="70" class="mr-3 rounded-circle img-thumbnail shadow-sm" style="background-color: white">
        @endif
        </div>
        <div class="col-sm pt-4">
          {{$customer->customer_first_name}} {{$customer->customer_last_name}}
        </div>
        <div class="col-sm pt-4">
          {{$customer->email}}
        </div>
        <div class="col-sm pt-4 text-center">
          Status: @if ($customer->customer_status == 1)
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

@section('footer')
  <div class="row container">
    <div class="col-3">
      Showing {{$customers->firstItem()}} - {{$customers->lastItem()}} of {{$customers->total()}}
    </div>
    <div class="col-0">
      <div class="btn-group float-end" style="color: yellow">
        {{$customers->links()}}
      </div>
    </div>
  </div>

@endsection

