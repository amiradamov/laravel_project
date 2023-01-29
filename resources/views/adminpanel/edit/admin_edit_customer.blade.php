@extends('layouts.app')
@section('body')
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
                            <img src="https://bootstrapious.com/i/snippets/sn-v-nav/avatar.png" alt="..." width="340" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                            <figcaption class="figure-caption text-center text-uppercase" style="font-size: 25px; color: white">
                                <div>{{$customer->customer_first_name}} {{$customer->customer_last_name}}</div>
                                <p class="mb-0 text-secondary" style="font-size: 12px"> {{$customer->customer_username}}</p>
                                <button class="btn" style="background-color:#494949; color: #FFC700; border-radius: 12px; border-width: 0">
                                    <i class="fa fa-fw fa-camera"></i>
                                    <span>Change Photo</span>
                                  </button>
                            </figcaption>
                        </figure>
                    </div>

                  <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                  </ul>
                  <div class="tab-content pt-3">
                    <div class="tab-pane active">
                      <form action="/update-admin-customer/{{$customer->id}}" method="POST" class="form" novalidate="">
                        {{-- @method('PATCH') --}}
                        @csrf
                        <div class="row">
                          <div class="col">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>First Name</label>
                                  <input class="form-control" type="text" name="firstname" placeholder="Enter First Name" value="{{$customer->customer_first_name}}">
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="lastname" placeholder="Enter Last Name" value="{{$customer->customer_last_name}}">
                              </div>
                              <div class="col">
                                <div class="form-group">
                                  <label>Username</label>
                                  <input class="form-control" type="text" name="username" placeholder="Enter Username" value="{{$customer->customer_username}}">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Email</label>
                                  <input class="form-control" type="text" name="email" placeholder="Enter Email Address" value="{{$customer->email}}"> 
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Contact Number</label>
                                    <input class="form-control" type="text" name="contact_number" placeholder="Enter Contact Number" value="{{$customer->customer_phone_number}}">
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" type="text" name="address" placeholder="Enter Address" value="{{$customer->address}}">
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-sm-6 mb-3">
                            <div class="mb-2 text-secondary"><b>Change Password</b></div>
                            <hr  style=" background-color:#ffffff">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Current Password</label>
                                  <input class="form-control" type="password" name="current_password" placeholder="Enter current password" value="{{$customer->customer_password}}">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>New <span class="d-none d-xl-inline">Password</span></label>
                                    <div class="input-group mb-3">
                                            <input name="new_password" type="password" value="" class="input form-control" id="new_password" placeholder="Enter new password" required="true" aria-label="password" aria-describedby="basic-addon1" />
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
                                            placeholder="Confirm new password" required="true" aria-label="password" aria-describedby="basic-addon1" />
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
                            <button class="btn bg-success" type="submit" style="color: white">Save Changes</button>
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
        <p>{{{ isset($id) ? $id : '' }}} </p>
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