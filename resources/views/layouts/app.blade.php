<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />

<!-- font awesome  -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />
    <title>Document</title>
</head>
<body>
    <!-- Vertical navbar -->
<div class="vertical-nav" id="sidebar" style="background-color: #363636; overflow: auto;">
  <div class="py-4 px-3" style="background-color: black">
    <div class="media d-flex align-items-center">
      <img src="https://bootstrapious.com/i/snippets/sn-v-nav/avatar.png" alt="..." width="95" class="mr-3 rounded-circle img-thumbnail shadow-sm">
      <a href="{{ url('admin/adminpage') }}">
        <div class="media-body">
          <h5 class="m-0 text-right" style="color: white">{{$data['name']}}</h5>
          <p class="font-weight-light text-muted mb-2 text-right">{{$user_type}}</p>
        </div>
      </a>
    </div>
</div>


  @if (Session('user_admin'))
    <ul class="nav flex-column" style="height: 830px">

    <li class="nav-item customer menu">
      <a href="{{ url('admin/customers') }}" class="nav-link">
                <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                Customers
      </a>
    </li>
    <li class="nav-item menu">
      <a href="#" class="nav-link">
                <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                Orders
            </a>
    </li>
    <hr  style="height:0.5px; width:100%; border-width:0; color:red; background-color:#505050">
    <li class="nav-item menu">
      <a href="#" class="nav-link">
                <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                Categories
            </a>
    </li>
    <li class="nav-item menu">
      <a href="#" class="nav-link">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Items
            </a>
    </li>
    <li class="nav-item menu">
      <a href="#" class="nav-link">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Ingredients
            </a>
    </li>
    <hr  style="height:0.5px; width:100%; border-width:0; color:red; background-color:#505050">
    <li class="nav-item menu">
      <a href="#" class="nav-link">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                User Types
            </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link menu">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Payment Method
            </a>
    </li>
    <hr  style="height:0.5px; width:100%; border-width:0; color:red; background-color:#505050">
    <li class="nav-item menu">
      <a href="#" class="nav-link col-sm-5 text-truncate">
                <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                Staff
            </a>
    </li>
    <li class="nav-item">
      <div class="d-flex justify-content-center">
        <a href=""><button type="button" class="btn menu_button" >Edit Info</button></a>
      </div>
    </li>
    
    <li class="nav-item mt-auto p-2">
      <hr  style="height:0.5px; width:100%; border-width:0; color:red; background-color:#505050">
      <div class="d-flex justify-content-center">
        <a href="logout"><button type="button" class="btn menu_logout">Log Out</button></a>
      </div>
    </li>
    
    </ul> 
  @endif

  @if(Session('moderator'))
  <ul class="nav flex-column" style="height: 830px">

    <li class="nav-item">
      <a href="/customers" class="nav-link">
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
    
    <li class="nav-item mt-auto p-2">
      <hr  style="height:0.5px; width:100%; border-width:0; color:red; background-color:#505050">
      <div class="d-flex justify-content-center">
        <a href="logout"><button type="button" class="btn"  style=" color: #ffffff; padding: 5px 50px; font-size: 20px; background-color: #FF0000">Log Out</button></a>
      </div>
    </li>
    
    </ul>
  @endif

  @if (Session('editor'))
  <ul class="nav flex-column" style="height: 830px">
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
    
    <li class="nav-item mt-auto p-2">
      <hr  style="height:0.5px; width:100%; border-width:0; color:red; background-color:#505050">
      <div class="d-flex justify-content-center">
        <a href="logout"><button type="button" class="btn"  style=" color: #ffffff; padding: 5px 50px; font-size: 20px; background-color: #FF0000">Log Out</button></a>
      </div>
    </li>
    </ul>
  @endif
  
  </div>
  <!-- End vertical navbar -->

  <!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

    @yield('body')
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