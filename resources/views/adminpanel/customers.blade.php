@extends('layouts.app')
@section('menu')

@endsection
{{-- <div>
        <table class="table table-dark">
            <tr>
                <th>#</th>
                <th>name</th>
                <th>surname</th>
                <th>email</th>
                <th>phone</th>
                <th>address</th>
                <th>Check orders</th>
            </tr>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->customer_first_name}}</td>
                    <td>{{$customer->customer_last_name}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->customer_phone_number}}</td>
                    <td>{{$customer->address}}</td>
                    <td>
                        <a href="{{ URL::to('customer/'.$customer->id) }}">View</a>
                    </td>
                </tr>
            @empty
                
            @endforelse
        </table>
</div> --}}

@section('body')
    <!-- Demo content -->
    <h2 class="display-4 text-white">Customers</h2>
    <hr  style=" background-color:#ffffff">
    {{-- <div class="container"> --}}
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
    {{-- </div> --}}
@endsection
