@extends('layouts.app')
@section('body')
<h2 class="display-4 text-white">Create Order for {{$customer->customer_first_name}} {{$customer->customer_last_name}}</h2>
<hr  style=" background-color:#ffffff">

<div class="editadmin"> 
        {{-- Search --}}
        <div class="container">
          @if (Session("success"))
          <div class="alert alert-success">
            {{session("success")}}
          </div>
        @endif
          <form action="">
            <div class="row mb-5 py-1 form-group " style="background-color: #D9D9D9; border-radius: 12px; "> 
              <div class="py-1 w-25 ml-3">
                <input type="search" name="search_item" id="" value="{{$search_item}}" class="form-control w-100  pr-6" placeholder="Search by category name" style="border-radius: 12px;">
              </div>
              <div class="col py-1" >
                <button class="btn" style="background-color:#494949; color: white; border-radius: 12px;">
                  Search
                </button>
                <a href="{{url('admin/customer/'.$customer->id.'/order')}}">
                  <button class="btn" type="button" style="background-color:#494949; color: white; border-radius: 12px;">
                    Reset
                  </button>
                </a>
              </div>
              <div class="col py-1 d-flex justify-content-end dropdown" style="position: relative">
                  <button class="btn btn-warning dropdown-toggle" type="button" style="border-radius: 12px;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                      @if (session('cart'))
                        @php
                          $cartCount = 0;
                          $cart = session('cart');
                          foreach ($cart as $item) {
                              $cartCount += $item['quantity'];
                          }
                        @endphp
                        <span class="badge badge-pill badge-danger">
                          {{ $cartCount }}  
                        </span>
                      @else
                        <span class="badge badge-pill badge-danger">
                          0  
                        </span>
                      @endif
                  </button>
                  
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin-right: 200px; width: 600px">
                    <div class="col" style="margin-left: 20px">
                      <div class="row">
                        <p class="h4">Cart</p>
                        <hr>
                      </div>
                      <div class="row">
                        <p>Number of items in cart:
                          @if (session('cart'))
                        <span class="badge badge-pill badge-danger">
                          {{ $cartCount }}  
                        </span>
                      @else
                        <span class="badge badge-pill badge-danger">
                          0  
                        </span>
                      @endif
                        </p>
                      </div>
                      <div class="row"></div>
                    </div>
                    <div class="row" style="margin-left: 1px">
                      @if (session('cart'))
                        <?php $total = 0 ?>
                        @foreach((array) session('cart') as $id => $details)
                            <?php $total += $details['price'] * $details['quantity'] ?>
                        @endforeach
                        <div class="col-lg-3 col-sm-6 col-6" style="vertical-align: bottom;">
                            Product
                        </div>
                        <div class="col-lg-3 col-sm-6 col-6">
                          Price
                        </div>
                        <div class="col-lg-3 col-sm-6 col-6">
                          Quantity
                        </div>
                        <div class="col-lg-1 col-sm-6 col-6">
                          Subtotal
                        </div>
                          
                      @else

                          <p></p>

                      @endif
                  </div>
                  <div class="row mt-3" style="margin-left: 1px">
                    <div class="col-lg-7 col-sm-5 col-6">
                      @if (session('cart'))

                        <button type="button" class="btn btn-success">Order</button>
                          
                      @else
                      
                        <button type="button" class="btn btn-secondary" disabled>Order</button>

                      @endif
                    </div>
                    <div class="col-lg-4 col-sm-6 col-6" style=" text-align: right" ><p class="h3">Total: 300$</p></div>
                  </div>
                </div>
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
              {{-- <p class="btn-holder"><a href="{{ url('add-to-cart-admin/'.$item->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a></p> --}}
              <button id="addToCartBtn" class="btn btn-warning btn-block text-center" role="button">Add to cart</button>

            </div>
          </div>
        </div>
        @empty
            
        @endforelse
      </div> 
</div>

<script>
  $(document).ready(function() {
      $('#addToCartBtn').on('click', function() {
          $.ajax({
              url: '{{ url('add-to-cart-admin/'.$item->id) }}',
              type: 'GET',
              success: function(response) {
                $cart[$id]['quantity']++;
                  // Do something with the response, such as update the cart count
                  // Example: $('#cartCount').text(response.cartCount);
              },
              error: function(xhr) {
                  // Handle any errors here
              }
          });
      });
  });
</script>


@endsection