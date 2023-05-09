@extends('layouts.app')
@section('body')
<h2 class="display-4 text-white">Create Category</h2>
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
                                      <img src="{{ asset("/def_images/def_category.png") }}" alt="New Customer" width="340" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                                      <figcaption class="figure-caption text-center text-uppercase" style="font-size: 25px; color: white">
                                      </figcaption>
                                  </figure>
                              </div>
                              
                            <div class="tab-content pt-3">
                              <div class="tab-pane active">
                                <form action="{{route('create-admin-category')}}" method="POST" class="form" enctype="multipart/form-data">
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
                                            <label>Category Name</label>
                                            <input class="form-control" type="text" name="catname" placeholder="Enter Category Name" value="">
                                          </div>
                                        </div>
                                      </div>
                                      {{-- Address --}}
                                      <div class="row">
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Description</label>
                                              <input class="form-control" type="text" name="description"placeholder="Enter Description" value="">
                                            </div>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col d-flex justify-content-end">
                                      <div class="pr-3">
                                        <a href="{{ URL::to('admin/categories') }}" style="text-decoration:none; color: white" >
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