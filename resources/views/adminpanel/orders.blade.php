@extends('layouts.app')
@section('menu')

@endsection

@section('body')
    <style>
      .customer {
        background-color: #272727;
      }
    </style>
      <h2 class="display-4 text-white">Orders</h2>
      <hr  style=" background-color:#ffffff">
      
      {{-- Search --}}
      <form action="">
        <div class="row py-1 form-group mb-5" style="background-color: #D9D9D9; border-radius: 12px; "> 
          <div class="py-1 col-4">
            <input type="search" name="search" id="" value="{{$search}}" class="form-control pr-6" placeholder="Search by ID" style="border-radius: 12px;">
          </div>
          <div class="py-1 col-2">
            <select class="form-control" id="statusType" name="statusType" style="border-radius: 12px; ">
                <option value="" style="display: none">Status Type</option>
                @foreach ($statusTypes as $statusType)
                    <option value="{{ $statusType }}" {{ $statusType == $selectStatus ? 'selected' : '' }}>{{ $statusType }}</option>
                @endforeach
            </select>
        </div>
          <div class="col py-1" >
            <button class="btn" style="background-color:#494949; color: white; border-radius: 12px;">
              Search
            </button>
            <a href="{{url('admin/orders/')}}">
              <button class="btn" type="button" style="background-color:#494949; color: white; border-radius: 12px;">
                Reset
              </button>
            </a>
          </div>
           <!-- Date filter input -->
        <div class="col py-1">
          {{-- <div class=""> --}}
              <input type="date" name="date" id="date" value="{{ $dateFilter }}" class="form-control" style="border-radius: 12px;">
        {{-- </div> --}}
        </div>
        </div>
      </form>
      
          {{-- Order_details --}}
          @foreach ($orders as $order)
            <a href="{{ URL::to('admin/customers/') }}" class="" style="font-size: 15px; color: white">
              <div class="row py-1 px-2 blonde mb-2" style="background-color: #565656; border-radius: 12px;">
                <div class="col-xm">
                  <img src="https://bootstrapious.com/i/snippets/sn-v-nav/avatar.png" alt="..." width="70" class="mr-3 rounded-circle img-thumbnail shadow-sm" style="background-color: #FFC700">
                </div>
                <div class="col-md-1 col-sm pt-4">
                    {{$order->order_id}}
                </div>
                <div class="col-sm pt-4">
                    {{$order->created_at}}
                </div>
                <div class="col-sm pt-4 text-center">
                  Status: {{$order->order_status}}
                </div>
                <div class="col-sm pt-4 text-center">
                    Processed by: {{$order->user_name}}
                </div>
              </div>
            </a>
          @endforeach

@endsection
