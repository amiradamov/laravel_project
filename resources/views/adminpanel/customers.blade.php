@extends('layouts.app')
@section('menu')

@endsection

@section('body')
    <h2 class="display-4 text-white">Customers</h2>
    <hr  style=" background-color:#ffffff">
      
      {{-- Search --}}
      <form action="">
          <div class="row mb-5 py-1 px-0 form-group" style="background-color: #D9D9D9; border-radius: 12px; ">
            <div class="col py-1">
              <input type="search" name="search" id="" class="form-control" placeholder="Search by name or email" style="border-radius: 12px;">
            </div>
            <div class="col pr-5 pl-0 py-1">
              <button class="btn" style="background-color:#494949; color: white; border-radius: 12px;">
                Search
              </button>
            </div>
          </div>
      </form>
      @forelse ($customers as $customer)
      <a href="" class="" style="font-size: 20px; color: white">
      <div class="row py-1 px-2 blonde mb-2" style="background-color: #565656; border-radius: 12px;">
        <div class="col-xm">
          <img src="https://bootstrapious.com/i/snippets/sn-v-nav/avatar.png" alt="..." width="70" class="mr-3 rounded-circle img-thumbnail shadow-sm" style="background-color: #FFC700">
        </div>
        <div class="col-sm pt-4">
          {{$customer->customer_first_name}} {{$customer->customer_last_name}}
        </div>
        <div class="col-sm pt-4">
          {{$customer->email}}
        </div>
        <div class="col-sm pt-4 text-center">
          {{$customer->order_num}}
        </div>
      </div>
    </a>
      @empty
          
      @endforelse
@endsection
