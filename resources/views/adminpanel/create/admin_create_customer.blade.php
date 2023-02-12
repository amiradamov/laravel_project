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
                                      <img src="{{ asset("/def_images/def_customer_profile.png") }}" alt="New Customer" width="340" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                                      <figcaption class="figure-caption text-center text-uppercase" style="font-size: 25px; color: white">
                                      </figcaption>
                                  </figure>
                              </div>
                              
                            <div class="tab-content pt-3">
                              <div class="tab-pane active">
                                <form action="{{route('create-admin-customer')}}" method="POST" class="form" enctype="multipart/form-data">
                                  @csrf
          
                                  {{-- image upload --}}
                                  <label for="formFile" class="form-label">Chose a file</label>
                                  <input type="file" class="form-control" name="image" id="formFile">
          
                                  <div class="row">
                                    <div class="col">
                                      <div class="row">
                                        {{-- First Name --}}
                                        <div class="col">
                                          <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" type="text" name="firstname" placeholder="Enter First Name" value="">
                                          </div>
                                        </div>
                                        {{-- Last Name --}}
                                        <div class="form-group">
                                          <label>Last Name</label>
                                          <input class="form-control" type="text" name="lastname" placeholder="Enter Last Name" value="">
                                        </div>
                                        {{-- UserName --}}
                                        <div class="col">
                                          <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" type="text" name="username" placeholder="Enter Username" value="">
                                          </div>
                                        </div>
                                      </div>
                                      {{-- Email --}}
                                      <div class="row">
                                        <div class="col">
                                          <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="text" name="email" placeholder="Enter Email Address" value=""> 
                                          </div>
                                        </div>
                                      </div>
                                      {{-- Contact Number --}}
                                      <div class="row">
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Contact Number</label>
                                              <input class="form-control" type="text" name="contact_number" placeholder="Enter Contact Number" value="">
                                            </div>
                                          </div>
                                      </div>
                                      {{-- Address --}}
                                      <div class="row">
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Address</label>
                                              <input class="form-control" type="text" name="address" placeholder="Enter Address" value="">
                                            </div>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-12 col-sm-6 mb-3">
                                      <div class="mb-2 text-secondary"><b>New Password</b></div>
                                      <hr  style=" background-color:#ffffff">
                                      <div class="row">
                                          <div class="col">
                                              <label>New <span class="d-none d-xl-inline">Password</span></label>
                                              <div class="input-group mb-3">
                                                      <input name="new_password" type="password" value="" class="input form-control" id="new_password" placeholder="Enter new password" aria-label="password" aria-describedby="basic-addon1" />
                                                      <div class="input-group-append">
                                                          <span class="input-group-text" onclick="new_password_show_hide();">
                                                          <i class="fas fa-eye" id="show_eye"></i>
                                                          <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                                          </span>
                                                      </div>
                                              </div>
                                          </div>
                                      </div>
          
                                      <div class="row">
                                          <div class="col">
                                              <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                              <div class="input-group mb-3">
                                                      <input name="confirm_password" type="password" value="" class="input form-control" id="confirm_password" 
                                                      placeholder="Confirm new password" aria-label="password" aria-describedby="basic-addon1" />
                                                      <div class="input-group-append">
                                                          <span class="input-group-text" onclick="confirm_password_show_hide();">
                                                          <i class="fas fa-eye" id="confirm_show_eye"></i>
                                                          <i class="fas fa-eye-slash d-none" id="confirm_hide_eye"></i>
                                                          </span>
                                                      </div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
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