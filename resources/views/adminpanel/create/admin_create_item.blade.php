@extends('layouts.app')
@section('body')
<h2 class="display-4 text-white">Create Item</h2>
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
                                      <img src="{{ asset("/def_images/def_item_profile.png") }}" alt="New Customer" width="340" class="mr-3 rounded-circle img-thumbnail shadow-sm" style="object-fit: cover;>
                                      <figcaption class="figure-caption text-center text-uppercase" style="font-size: 25px; color: white">
                                      </figcaption>
                                  </figure>
                              </div>
                              
                            <div class="tab-content pt-3">
                              <div class="tab-pane active">
                                <form action="{{route('create-admin-item')}}" method="POST" class="form" enctype="multipart/form-data">
                                  @csrf
          
                                  {{-- image upload --}}
                                  <label for="formFile" class="form-label">Chose a file</label>
                                  <input type="file" class="form-control" name="image" id="formFile">
          
                                  <div class="row">
                                    <div class="col">
                                      <div class="row">
                                        {{-- Item Name --}}
                                        <div class="col">
                                          <div class="form-group">
                                            <label>Item Name</label>
                                            <input class="form-control" type="text" name="item_name" placeholder="Enter Item Name" value="">
                                          </div>
                                        </div>
                                        {{-- Item Price --}}
                                        <div class="form-group">
                                          <label>Item Price</label>
                                          <input class="form-control" type="number" name="item_price" placeholder="Enter Item Price" value="" novalidate>
                                        </div>
                                        {{-- Select Category --}}
                                        {{-- <div class="col"> --}}
                                            {{-- <div class="col py-1 ml-3"> --}}
                                                <div class="col">
                                                    <label>Select Category</label>
                                                    <select class="form-select form-select-lg w-100" id="productType" name="productType"
                                                    style="height: 35px">
                                                      <option id="selectCategory" style="display:none;" value="">Select Category</option>
                                                      @forelse ($categories as $category)
                                                      <option value={{$category->id}} id={{$category->category_name}}>{{$category->category_name}}</option>
                                                      @empty
                                                      @endforelse
                                                  </select>
                                                </div>
                                            {{-- </div> --}}
                                        {{-- </div> --}}
                                      </div>
                                      {{-- Item Description --}}
                                      <div class="row">
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Item Description</label>
                                              <input class="form-control" type="text" name="item_description" placeholder="Enter Item Description" value="">
                                            </div>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col d-flex justify-content-end">
                                      <div class="pr-3">
                                        <a href="{{ URL::to('admin/items') }}" style="text-decoration:none; color: white" >
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
    {{-- JS FUNCTION TO TOGGLE THE PASSWORD SHOW HIDE --}}
    <script>
        function new_password_show_hide() {
            var x = document.getElementById("new_password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        function confirm_password_show_hide() {
            var x = document.getElementById("confirm_password");
            var show_eye = document.getElementById("confirm_show_eye");
            var hide_eye = document.getElementById("confirm_hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
@endsection