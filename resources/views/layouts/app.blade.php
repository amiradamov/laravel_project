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
<div class="vertical-nav" id="sidebar" style="background-color: #363636; overflow: auto;">
    @yield('info')
  
    {{-- <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p> --}}
  
    <ul class="nav flex-column" style="height: 830px">
      @yield('menu')

      <li class="nav-item mt-auto p-2">
        <hr  style="height:0.5px; width:100%; border-width:0; color:red; background-color:#505050">
        <div class="d-flex justify-content-center">
          <a href=""><button type="button" class="btn"  style=" color: #ffffff; padding: 5px 50px; font-size: 20px; background-color: #FF0000">Log Out</button></a>
        </div>
      </li>
      
    </ul> 
  </div>
  <!-- End vertical navbar -->

  <!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

    @yield('body')

  </div>
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