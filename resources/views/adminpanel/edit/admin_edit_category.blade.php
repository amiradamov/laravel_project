@extends('layouts.app')
@section('body')
<div class="container editadmin">
    @if (Session("success"))
    <div class="alert alert-success">
      {{session("success")}}
    </div>
  @endif
  @if (Session("fail"))
    <div class="alert alert-danger">
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
    <div class="row flex-lg-nowrap">
    
      <div class="col">
        <div class="row">
          <div class="col mb-3">
            <div class="card" style="border: none; border-radius: 12px">
              <div class="card-body"  style="background-color: #363636; border-radius: 12px">
                <div class="e-profile">

                    <div class="container text-center">
                        <figure class="figure">
                          @if (1 < 0)
                            <img src="{{ asset("images/$customer->profile_image") }}" alt="{{ $customer->customer_first_name }} {{ $customer->customer_last_name }}" width="340" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                          @else
                            <img src="{{ asset("/def_images/def_category.png") }}" alt="{{ $category->category_name}}" width="340" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                          @endif
                            <figcaption class="figure-caption text-center text-uppercase" style="font-size: 25px; color: white">
                                <div>{{$category->category_name}}</div>
                            </figcaption>
                        </figure>
                    </div>

                  <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                  </ul>
                  <div class="tab-content pt-3">
                    <div class="tab-pane active">
                      <form action="/update-admin-category/{{$category->id}}" method="POST" class="form" enctype="multipart/form-data">
                        @csrf

                        {{-- image update --}}
                        <label for="formFile" class="form-label">Chose a file</label>
                        <input type="file" class="form-control" name="image" id="formFile">

                        <div class="row">
                          <div class="col">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Category Name</label>
                                  <input class="form-control" type="text" name="catname" placeholder="Enter Category Name" value="{{$category->category_name}}">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Description</label>
                                    <input class="form-control" type="text" name="description" placeholder="Enter Description" value="{{$category->description}}">
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-sm-6 mb-3">
                            <div class="mb-2 text-secondary"><b>Change Status</b></div>
                            <hr  style=" background-color:#ffffff">
                            
                            <input type="checkbox" data-toggle="toggle" data-on="Activated" data-off="Deactivated" data-onstyle="success" data-offstyle="danger" name="status" value="1" {{ $category->category_status == 1 ? 'checked' : '' }}>

                          </div>
                        </div>
                        <div class="row">
                          <div class="col d-flex justify-content-end">
                            <div class="pr-3">
                              <a href="{{ URL::to('admin/category/'.$category->id) }}" style="text-decoration:none; color: white" >
                                <div class="btn" style="color: white; background-color:#494949">cancel</div>
                              </a>
                            </div>
                            <button class="btn bg-success" type="submit" style="color: white" name="submit" value="submit">Save Changes</button>
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