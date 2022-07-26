<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WMSU-Palaro</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        @vite([
            'resources/css/app.css',
            'resources/css/mobile.css',
            'resources/js/app.js',
            '../../node_modules/bootstrap/dist/css/bootstrap.css',
            '../../node_modules/bootstrap/dist/js/bootstrap.bundle.js',
        ])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    </head>
  <body class="antialiased">
         <div id="wrapper"></div>
         <button id="btnup" class="d-none"><i class="fas fa-caret-up"></i></button>
<nav class="nav1 shadow" >

<div class="container-fluid">
  <div class="Sidelink">
       <a href="/login" class="hf fs">SignIn</a>    
   </div>            
</div>       
</nav>
<nav class="nav2" id="nav2">
  <div class="container-fluid row">
    <div class="col-md-6">
      <a class="navbar-brand logo hf" href="/">
        <img src="{{asset('assets/img/wmsu.jpg')}}" class="rounded-circle" alt="">
        {{-- <img src="{{asset('assets/img/wmsu.jpg')}}" alt=""> --}}
       <span id="text-wmsu">Western Mindanao State University</span>  
      </a>
    </div>
    <div class="col-md-6">

      <div class="navs">
        <a href="">Home</a>
        <a href="">Events</a>
        <a href="">Media</a>
        <a href="">Announcement</a>
        <a href="">About</a>
        
      </div>
      @if(Auth::check())
          {{-- If Login.. --}}
      <div class="dropdown" id="Options">
        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          {{ Auth::user()->name }}  <br>
         <span style="font-size:13px">Profile</span>
        </button>
        <ul class="dropdown-menu"  aria-labelledby="dropdownMenuButton1">
          @if(Auth::user()->user_type == 'superadmin')
          <li><a class="dropdown-item" href="{{route('admin.dashboard')}}">Dashboard</a></li>
          @elseif(Auth::user()->user_type == 'coordinator')
          <li><a class="dropdown-item" href="{{route('coordinator.dashboard')}}">Dashboard</a></li>
          @endif
        
          <li><a class="dropdown-item" href="#">Join a Game</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
        </ul>
      </div>


      @else 

      @endif
    
 <button class="" id="btn-open-canvas" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
  <i class="fas fa-bars"></i>  
</button>

    </div>
   
  
 
  </div>
</nav>



<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
   
    <button type="button" style="position: absolute;right:20px;top:20px" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
 
  <h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
  <div class="offcanvas-body" id="navmobile">
   

  </div>
</div>
@yield('carousel')
@yield('schedule_events')
@yield('announcement')
@yield('videostream')
@yield('sport_coordinators')

<br>
<br>
<footer>
  <h6 >CopyRights &middot; 2022 | WMSU-PALARO</h6>
</footer>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      var navs = $('.navs').html();
      var logo = $('.logo').html();
        $('#navmobile').html(navs);
        $('#offcanvasExampleLabel').html(logo);
    })
  </script>
    </body>
</html>
