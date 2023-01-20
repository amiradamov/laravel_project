<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->  

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src ="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src ="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />
    <title>Document</title>
</head>
<body>
    <!-- Vertical navbar -->
<div class="vertical-nav" id="sidebar" style="background-color: #363636">
    <div class="py-4 px-3 mb-" style="background-color: black">
      <div class="media d-flex align-items-center"><img src="https://bootstrapious.com/i/snippets/sn-v-nav/avatar.png" alt="..." width="95" class="mr-3 rounded-circle img-thumbnail shadow-sm">
        <div class="media-body">
          <h4 class="m-0 text-right" style="color: white">Jason Doe</h4>
          <p class="font-weight-light text-muted mb-2 text-right">admin</p>
        </div>
      </div>
    </div>
  
    {{-- <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p> --}}
  
    <ul class="nav flex-column mb-0">
      <li class="nav-item">
        <a href="#" class="nav-link" style="background-color: #272727">
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
    </ul> 
  </div>
  <!-- End vertical navbar -->

  <!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>
  
    <!-- Demo content -->
    <h2 class="display-4 text-white">Bootstrap vertical nav</h2>
    <p class="lead text-white mb-0">Build a fixed sidebar using Bootstrap 4 vertical navigation and media objects.</p>
    <p class="lead text-white">Snippet by <a href="https://bootstrapious.com/snippets" class="text-white">
          <u>Bootstrapious</u></a>
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
  
  </div>
  <!-- End demo content -->
  
        
    {{-- <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                @yield('content')
            </div>
        </div>
    </div> --}}
    @yield('footer')
</body>

<script>
    $(function() {
  // Sidebar toggle behavior
  $('#sidebarCollapse').on('click', function() {
    $('#sidebar, #content').toggleClass('active');
  });
});
</script>
</html>