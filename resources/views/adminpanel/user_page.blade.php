@section('css')
    color: green;
@endsection
@extends('layouts.app')
@section('menu')

  <li class="nav-item">
    <a href="/customers" class="nav-link" style="background-color: #272727">
              <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
              Customers
    </a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link">
              <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
              Orders
          </a>
  </li>
  <hr  style="height:0.5px; width:100%; border-width:0; color:red; background-color:#505050">
  <li class="nav-item">
    <a href="#" class="nav-link">
              <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
              Categories
          </a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link">
              <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
              Items
          </a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link">
              <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
              Ingredients
          </a>
  </li>
  <hr  style="height:0.5px; width:100%; border-width:0; color:red; background-color:#505050">
  <li class="nav-item">
    <a href="#" class="nav-link">
              <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
              User Types
          </a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link">
              <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
              Payment Method
          </a>
  </li>
  <hr  style="height:0.5px; width:100%; border-width:0; color:red; background-color:#505050">
  <li class="nav-item">
    <a href="#" class="nav-link col-sm-5 text-truncate">
              <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
              Staff
          </a>
  </li>
  <li class="nav-item">
    <div class="d-flex justify-content-center" style>
      <a href=""><button type="button" class="btn"  style=" color: #FFC700; padding: 5px 50px; font-size: 20px; background-color: #494949;">Edit Info</button></a>
    </div>
  </li>

@endsection

{{-- <div>
        <table class="table table-dark">
            <tr>
                <th>#</th>
                <th>name</th>
                <th>surname</th>
                <th>email</th>
                <th>phone</th>
                <th>address</th>
                <th>Check orders</th>
            </tr>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->customer_first_name}}</td>
                    <td>{{$customer->customer_last_name}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->customer_phone_number}}</td>
                    <td>{{$customer->address}}</td>
                    <td>
                        <a href="{{ URL::to('customer/'.$customer->id) }}">View</a>
                    </td>
                </tr>
            @empty
                
            @endforelse
        </table>
</div> --}}

@section('body')
    <!-- Demo content -->
    <h2 class="display-4 text-white">{{$data->name}}</h2>
    <p class="lead text-white mb-0 text-uppercase">{{$user_type}}</p>
    </p>
    <div class="separator"></div>
    <div class="row text-white">
      <div class="col-lg-7">
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
          dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
          dolor.
        </p>
        <div class="bg-white p-5 rounded my-5 shadow-sm">
          <p class="lead font-italic mb-0 text-muted">"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
            irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
        </div>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
          dolor.
        </p>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
          dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
          dolor.
        </p>
      </div>
      <div class="col-lg-5">
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
          dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
          dolor.
        </p>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
          dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
          dolor.
        </p>
      </div>
    </div>
@endsection
