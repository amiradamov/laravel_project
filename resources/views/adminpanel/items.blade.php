@extends('layouts.app')
@section('menu')

@endsection

@section('body')
<style>
  .card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 300px;
    margin: auto;
    text-align: center;
    font-family: arial;
  }
  
  .price {
    color: grey;
    font-size: 22px;
  }
  
  .card button {
    border: none;
    outline: 0;
    padding: 12px;
    color: white;
    background-color: #000;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
  }
  
  .card button:hover {
    opacity: 0.7;
  }
</style>

      <h2 class="display-4 text-white">Items</h2>
      <hr  style=" background-color:#ffffff">
      
      {{-- Search --}}
      <form action="">
          <div class="row mb-5 py-1 form-group " style="background-color: #D9D9D9; border-radius: 12px; "> 
            <div class="col-4 py-1">
              <select class="form-control" id="productType" name="productType" style="border-radius: 12px;">
                <option id="selectCategory" style="display:none;" value="">@if ($search != "")
                  {{$search}}
                @else
                  Select Category
                @endif</option>
                @forelse ($categories as $category)
                <option value="{{$category->category_name}}" id={{$category->category_name}}>{{$category->category_name}}</option>
                @empty
                @endforelse
            </select>
          </div>
          <div class="col py-1" >
              <button class="btn" style="background-color:#494949; color: white; border-radius: 12px;">
                  Search
              </button>
              <a href="{{url('admin/items')}}">
                  <button class="btn" type="button" style="background-color:#494949; color: white; border-radius: 12px;">
                  Reset
                  </button>
              </a>
          </div>
          <div class="col py-1 d-flex justify-content-end">
              <a href="{{url('admin/'.$data->id.'/create/item')}}">
                  <button class="btn" type="button" style="background-color:#494949; color: white; border-radius: 12px;">
                  Create New Item
                  </button>
              </a>
          </div>
        </div>
      </form>
      
      {{-- Items --}}
        <div class="row">
            @forelse ($items as $item)
            <div class="col-md-3 mb-4">
                <div class="card">
                  @if ($item->item_image != "")
                    <img src="{{ asset("item_images/$item->item_image") }}" alt="{{ $item->item_name }}" class="" style="background-color: white" style="width:100%">
                  @else
                    <img src="{{ asset("/def_images/def_item_profile.png") }}" aalt="{{ $item->item_name }}" style="background-color: white" style="width:100%">
                  @endif
                <div class="card-body">
                    <h5 class="card-title">{{$item->item_name}}</h5>
                    <p class="price">${{$item->item_price}}</p>
                    <p class="btn-holder">
                    <p>{{ Str::limit($item->item_description, 90) }}</p>
                    <button class="btn btn-warning btn-block text-center add-to-cart-btn" data-id="{{$item->id}}">Edit Item</button>
                    </p>
                </div>
                </div>
            </div>
            @empty
                
            @endforelse
        </div>
@endsection

@section('footer')
  <div class="row container">
    <div class="col-3">
      Showing {{$items->firstItem()}} - {{$items->lastItem()}} of {{$items->total()}}
    </div>
    <div class="col-0">
      <div class="btn-group float-end" style="color: yellow">
        {{$items->links()}}
      </div>
    </div>
  </div>

@endsection

