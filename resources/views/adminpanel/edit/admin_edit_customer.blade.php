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
                                <div>Amir</div>
                                <button class="btn" style="background-color:#494949; color: #FFC700; border-radius: 12px; border-width: 0">
                                    <i class="fa fa-fw fa-camera"></i>
                                    <span>Change Photo</span>
                                  </button>
                                {{-- <button class="btn btn-primary" type="button">
                                    <i class="fa fa-fw fa-camera"></i>
                                    <span>Change Photo</span>
                                </button> --}}
                            </figcaption>
                        </figure>
                    </div>
                  {{-- <div class="row">
                    <div class="col-12 col-sm-auto mb-3">
                      <div class="mx-auto" style="width: 140px;">
                        <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                          <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
                        </div>
                      </div>
                    </div>
                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                      <div class="text-center text-sm-left mb-2 mb-sm-0">
                        <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">John Smith</h4>
                        <p class="mb-0">@johnny.s</p>
                        <div class="mt-2">
                          <button class="btn btn-primary" type="button">
                            <i class="fa fa-fw fa-camera"></i>
                            <span>Change Photo</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                  <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                  </ul>
                  <div class="tab-content pt-3">
                    <div class="tab-pane active">
                      <form class="form" novalidate="">
                        <div class="row">
                          <div class="col">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>First Name</label>
                                  <input class="form-control" type="text" name="firstname" placeholder="John Smith" value="John Smith">
                                </div>
                              </div>
                              <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="lastname" placeholder="johnny.s" value="johnny.s">
                              </div>
                              <div class="col">
                                <div class="form-group">
                                  <label>Username</label>
                                  <input class="form-control" type="text" name="username" placeholder="johnny.s" value="johnny.s">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Email</label>
                                  <input class="form-control" type="text" placeholder="Enter Email Address">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Contact Number</label>
                                    <input class="form-control" type="text" placeholder="Enter Contact Number">
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" type="text" placeholder="Enter Address">
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-sm-6 mb-3">
                            <div class="mb-2" style="color: white"><b>Change Password</b></div>
                            <hr  style=" background-color:#ffffff">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Current Password</label>
                                  <input class="form-control" type="password" placeholder="••••••">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>New Password</label>
                                  <input class="form-control" type="password" placeholder="••••••">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                  <input class="form-control" type="password" placeholder="••••••"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
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