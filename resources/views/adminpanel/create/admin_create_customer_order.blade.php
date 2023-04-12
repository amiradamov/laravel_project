
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
              <div class="col d-flex justify-content-end dropdown" style="">
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
                      <span id="cart-count" class="badge badge-pill badge-danger">
                          {{ $cartCount }}  
                      </span>
                  @else
                      <span id="cart-count" class="badge badge-pill badge-danger">
                          0  
                      </span>
                  @endif
              </button>
              
                  
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin-right: 200px; width: 800px; max-height: 520px; overflow:scroll; overflow-x: hidden">
                    <div class="col" style="margin-left: 20px">
                      <div class="row">
                        <p class="h4">Cart</p>
                        <hr>
                      </div>
                      <div class="row">
                        <p>Number of items in cart:
                          <span class="badge badge-pill badge-danger" id="inner-cart-count">
                            {{ $cartCount ?? 0 }}
                        </span>
                        </p>
                      </div>
                    </div>
                    <div class="row container mx-0">
                      @if (session('cart'))
                        <?php $total = 0 ?>
                        @foreach((array) session('cart') as $id => $details)
                            <?php $total += $details['price'] * $details['quantity'] ?>
                        @endforeach
                          <table class="table">
                            <thead>
                              <tr>
                                <th scope="col" class="col-5">Product</th>
                                <th scope="col" class="col-2" >Quantity</th>
                                <th scope="col" class="col-1">Price</th>
                                <th scope="col" class="col-1"></th>
                              </tr>
                            </thead>
                            <tbody cart-items>
                                  <!-- Cart items will be added here -->
                            </tbody>
                          </table>
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
              <p class="btn-holder">
                <button class="btn btn-warning btn-block text-center add-to-cart-btn" data-id="{{$item->id}}">Add to cart</button>
              </p>
            </div>
          </div>
        </div>
        @empty
            
        @endforelse

        <div class="container"></div>
        <button onclick="addDiv()">Add Div</button>
        <script>
          function addDiv() {
            let container = document.querySelector('.container');
            let div = document.createElement('div');
            div.classList.add('box');
            div.innerHTML = container.childElementCount + 1;
            container.appendChild(div);
          }
        </script>
        <div id="cart-items"></div>
      </div> 
</div>

<script>
  $(".dropdown-menu").click(function(event){
      event.stopPropagation();
    });
  $(document).ready(function(){
    var quantitiy=0;
    $('.quantity-right-plus').click(function(e){  
      // Stop acting like a button
      e.preventDefault();
      // Get the field name
      var quantity = parseInt($('#quantity').val());
      // If is not undefined
      $('#quantity').val(quantity + 1);
      // Increment
    });
    $('.quantity-left-minus').click(function(e){
      // Stop acting like a button
      e.preventDefault();
      // Get the field name
      var quantity = parseInt($('#quantity').val());
      
      // If is not undefined
    
      // Increment
      if(quantity>0){
        $('#quantity').val(quantity - 1);
      }
    });
      
  });
  $(document).on('click', '.add-to-cart-btn', function(){
        var itemId = $(this).data('id');
        $.ajax({
            url: "{{ url('add-to-cart') }}",
            type: "POST",
            data: {
                id: itemId,
                _token: '{{ csrf_token() }}'
            },
            success: function(data){
                // Show success message
                // alert(data.cartCount);
                document.getElementById('cart-count').innerHTML = data.cartCount;
                document.getElementById('inner-cart-count').innerHTML = data.cartCount;
                var cartItem = '<tr id="item-container">'+
                                '<td>' +
                                  '<div class="row">' +
                                    '<div class="col-3">' +
                                      '<img src="https://d1avenlh0i1xmr.cloudfront.net/8a716a93-7540-4ff2-91d8-a656847a4de9/24.jpg" alt="" width="70px">' +
                                    '</div>' +
                                    '<div class="col">' +
                                      '<p>' +
                                        data.name
                                        '</p>' +
                                    '</div>' +
                                  '</div>' +
                                '</td>' +
                                '<td>' +
                                  '<div class="col mt-1" style="margin-right: 0; padding-left: 0;">' +
                                    '<div class="input-group">' +
                                      '<span class="input-group-btn">' +
                                          '<button type="button" class="quantity-left-minus btn btn-warning btn-number"  data-type="minus" data-field="" style="border-top-right-radius: 0; border-bottom-right-radius: 0; width: 30px;" >' +
                                            -
                                          '</button>' +
                                      '</span>' +
                                      '<input type="text" id="quantity" name="quantity" class="form-control input-number" value= data.quantity min="1" max="100" size="5px">' +
                                      '<span class="input-group-btn">' +
                                          '<button type="button" class="quantity-right-plus btn btn-warning btn-numbe" data-type="plus" data-field="" style="border-top-left-radius: 0; border-bottom-left-radius: 0; width: 30px;">' +
                                              +
                                          '</button>' +
                                      '</span>' +
                                    '</div>' +
                                  '</div>' +
                                '</td>' +
                                '<td>' +
                                  '<div class="mt-1">' +
                                    data.price
                                  '</div>' +
                                '</td>' +
                                '<td>' +
                                  '<div class="mt-1">' +
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">' +
                                      '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>' +
                                      '<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>' +
                                    '</svg>' +
                                  '</div>' +
                                '</td>' +
                              '</tr>';
                              $('#cart-items').append(cartItem);
            }
        });
    });
  
</script>


@endsection