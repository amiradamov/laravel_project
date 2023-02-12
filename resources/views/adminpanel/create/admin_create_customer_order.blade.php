@extends('layouts.app')
@section('body')
<h2 class="display-4 text-white">Create Customer</h2>
<hr  style=" background-color:#ffffff">

@if (Session("success"))
<div class="alert alert-success">
    {{session("success")}}
</div>   
@endif
@if (Session("fail"))
<div class="alert alert-fail">
    {{session("fail")}}
</div>
@endif
@if(count($errors))
<div class="form-group">
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
</div>
@endif

<div class="container editadmin">
    <div class="row flex-lg-nowrap">
        <div class="col">
            <div class="row">
                <div class="col mb-3">
                    <div class="card" style="border: none; border-radius: 12px">
                        <div class="card-body"  style="background-color: #363636; border-radius: 12px">
                          <div class="e-profile">
          
                              <div class="container text-center">
                                <figure class="figure">
                                    @if ($customer->profile_image != "")
                                      <img src="{{ asset("$customer->profile_image") }}" alt="{{ $customer->customer_first_name }} {{ $customer->customer_last_name }}" width="340" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                                    @else
                                      <img src="{{ asset("/def_images/def_customer_profile.png") }}" alt="{{ $customer->customer_first_name }} {{ $customer->customer_last_name }}" width="340" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                                    @endif
                                      <figcaption class="figure-caption text-center text-uppercase" style="font-size: 25px; color: white">
                                          <div>{{$customer->customer_first_name}} {{$customer->customer_last_name}}</div>
                                          <p class="mb-0 text-secondary" style="font-size: 12px"> {{$customer->customer_username}}</p>
                                      </figcaption>
                                  </figure>
                              </div>
                              
                            <div class="tab-content pt-3">
                              <div class="tab-pane active">
                                <form action="{{route('create-admin-customer')}}" method="POST" class="form" enctype="multipart/form-data">
                                  @csrf
 
                                  {{-- Select category --}}
                                  <label for="formFile" class="form-label">Select category</label>
                                  <div class="input-group mb-3">
                                    <select class="custom-select" id="inputGroupSelect04">
                                      <option selected>Choose...</option>
                                      @foreach ($categories as $category)
                                          <option value="{{$category->id}}">{{$category->category_name}}</option>
                                      @endforeach
                                    </select>
                                    <div class="input-group-append">
                                      <button class="btn btn-outline-secondary" type="button">Select</button>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <br>
                                    <div class="col d-flex justify-content-end">
                                      <div class="pr-3">
                                        <a href="{{ URL::to('admin/customers') }}" style="text-decoration:none; color: white" >
                                          <div class="btn" style="color: white; background-color:#494949">cancel</div>
                                        </a>
                                      </div>
                                      <input class="btn bg-success" type="submit" style="color: white">
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection