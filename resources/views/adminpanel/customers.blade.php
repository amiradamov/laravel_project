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
      <div class="row py-2 px-2 blonde" style="background-color: #565656; border-radius: 12px;">
        <div class="col-xm">
          <img src="https://bootstrapious.com/i/snippets/sn-v-nav/avatar.png" alt="..." width="120" class="mr-3 rounded-circle img-thumbnail shadow-sm">
        </div>
        <div class="col-sm">
          {{$customer->customer_first_name}} {{$customer->customer_last_name}}
        </div>
        <div class="col-sm">
          {{$customer->email}}
        </div>
        <div class="col-sm">
          {{$customer->order_num}}
        </div>
      </div>
      <br>
      @empty
          
      @endforelse
    {{-- </div> --}}
@endsection
