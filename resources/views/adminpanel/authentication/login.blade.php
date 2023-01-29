@extends('layouts.templogin')
@section('content')
<section class="form-01-main">
    <div class="form-cover">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <form action="{{route('login-admin')}}" method="POST">
            @csrf
            <div class="form-sub-main">
              {{-- <div class="_main_head_as">
                <a href="#">
                  <img src="assets/images/vector.png">
                </a>
              </div> --}}
              <div class="form-group">
                  <input id="username" name="username" class="form-control _ge_de_ol" type="text" placeholder="User Name" aria-required="true">
              </div>
  
              <div class="form-group">                                              
                <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                
              </div>
  
              {{-- <div class="form-group">
                <div class="check_box_main">
                  <a href="#" class="pas-text">Forgot Password</a>
                </div>
              </div> --}}
  
              <div class="form-group">
                <div class="btn_uy">
                  <input type="submit" value="Login">
                </div>
              </div>
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
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>
  </section>
@endsection