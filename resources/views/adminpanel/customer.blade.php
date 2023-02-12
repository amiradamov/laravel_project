@extends('layouts.app')
@section('body')


<div class="container text-center">
        <figure class="figure">
          @if ($customer->profile_image != "")
          <img src="{{ asset("$customer->profile_image") }}" alt="{{ $customer->customer_first_name }} {{ $customer->customer_last_name }}" width="340" class="mr-3 rounded-circle img-thumbnail shadow-sm">
        @else
          <img src="{{ asset("/def_images/def_customer_profile.png") }}" alt="{{ $customer->customer_first_name }} {{ $customer->customer_last_name }}" width="340" class="mr-3 rounded-circle img-thumbnail shadow-sm">
        @endif
            <figcaption class="figure-caption text-center text-uppercase" style="font-size: 25px; color: white">{{$customer->customer_first_name}} {{$customer->customer_last_name}}</figcaption>
        </figure>
</div>

<div class="container text-center"> 
    {{-- <div class="col py-1" > --}}
      <a href="{{ URL::to('admin/customer/'.$customer->id.'/edit') }}">
        <button class="btn-lg" style="background-color:#494949; color: #FFC700; border-radius: 12px; border-width: 0">
          Edit Profile
        </button>
      </a>
      <a href="{{url('admin/customers')}}">
        <button class="btn-lg" type="button" style="background-color:red; color: white; border-radius: 12px; border-width: 0">
          Delete Account
        </button>
      </a>
    {{-- </div> --}}
  </div>
<hr  style=" background-color:#ffffff">




<div class="row">
    <div class="col">
        Email: {{$customer->email}}
    </div>
    <div class="col">
        Phone: {{$customer->customer_phone_number}}
    </div>
    <div class="col text-wrap">
        Address: {{$customer->address}}
    </div>
    <div class="col active">
        Status: @if ($customer->customer_status == 1)
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
            <a href="{{url('admin/customers')}}">
              <button class="btn" type="button" style="background-color:#494949; color: white; border-radius: 12px;">
                Reset
              </button>
            </a>
          </div>
        </div>
    </form>

          {{-- Order_details --}}
          @forelse ($customer->user as $user)
          <a href="{{ URL::to('admin/customer/'.$customer->id) }}" class="" style="font-size: 20px; color: white">
          <div class="row py-1 px-2 blonde mb-2" style="background-color: #565656; border-radius: 12px;">
            <div class="col-xm">
              <img src="https://bootstrapious.com/i/snippets/sn-v-nav/avatar.png" alt="..." width="70" class="mr-3 rounded-circle img-thumbnail shadow-sm" style="background-color: #FFC700">
            </div>
            <div class="col-sm pt-4">
                {{$user->pivot['id']}}
            </div>
            <div class="col-sm pt-4">
                {{$user->pivot['created_at']}}
            </div>
            <div class="col-sm pt-4 text-center">
                Processed by: {{$user['name']}}
            </div>
          </div>
        </a>
          @empty
              
          @endforelse
@endsection



{{-- <table class="table table-dark">
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
</table> --}}