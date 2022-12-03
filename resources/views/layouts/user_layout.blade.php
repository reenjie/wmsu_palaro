@guest 
<script>
    window.location.href = '/';
</script>
@else 
@if (Auth::user()->user_type == 'student')
    @else 
    <script>
        window.location.href = '/';
    </script> 
@endif

@endguest
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin-Palaro_CMS</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/mobile.css')}}">




    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  

</head>

<body>

    <div id="app">
        <nav class="sidenav shadow" id="navitems">
            <div class="userinfo">
                <img src="https://cdn.onlinewebfonts.com/svg/img_337050.png" class="img-thumbnnail shadow"
                    style="width: 60px;height: 60px;border-radius: 30px;">



                <div class="dropdown" style="font-weight: bolder;z-index: 9999">

                  @if(Auth::check())  {{ Auth::user()->name }} @endif<span id="username" class="dropdown-toggle" type="button"
                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></span>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="font-size: 13px;">
                        <li><a class="dropdown-item" href="{{route('user.profile')}}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.logout') }} ">Logout</a></li>

                    </ul>
                </div>

                <span style="font-weight: normal;font-size: 12px">  @if(Auth::check())   {{ Auth::user()->email }} @endif</span>

            </div>
          <br>
            <div class="navigations">



                <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="font-size: 14px">




                    <div class="sidebar-heading text-danger" style="font-size: 10px;margin-left:10px">
                        REPORTS
                    </div>

                    <li class="nav-item navitems">
                  <a class="nav-link navlinks " href="{{route('user.dashboard')}}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>





                    <!-- Divider -->
           
                    <!-- Heading -->
                    <div class="sidebar-heading text-danger" style="font-size: 10px;margin-left:10px">
                        MANAGE
                    </div>

                    <li class="nav-item navitems">
                        <a class="nav-link navlinks  " href="{{route('user.stream')}}">
                            <i class="fas fa-link"></i>
                            <span>Stream</span></a>
                    </li>

                    <li class="nav-item navitems">
                        <a class="nav-link navlinks  " href="{{route('user.join')}}">
                            <i class="fas fa-ranking-star"></i>
                            <span>Join-Event</span></a>
                    </li>

                    <li class="nav-item navitems">
                        <a class="nav-link navlinks  " href="{{route('user.about')}}">
                            <i class="fas fa-info-circle"></i>
                            <span>About</span></a>
                    </li>

               

                












                </ul>


            </div>


        </nav>


        <div class="topbar shadow-sm">

            <a class=" hf" id="canvas" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
               <i class="fas fa-bars"></i>
            </a>


            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header" style="  background-color: #7e78786b;">
                    <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel"></h5>
                    <button type="button" class="btn-close " data-bs-dismiss="offcanvas"
                        style="background-color: white;" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" id="canvasitems">

                </div>
            </div>


            <h6 class="text-primary text-light hf" id="abtext">
                WMSU-PALARO
            </h6>

        </div>

        <main class="py-4">
            <div class="mt-5"></div>
            @yield('content')
        </main>
    </div>
    <h6 id="res" class="hf">All rights Reserved &middot; 2022</h6>

    <script>
        var div1 = document.getElementById("navitems");
        var div1html = document.getElementById("canvasitems");
        div1html.innerHTML = div1.innerHTML;
    </script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>         

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
$(document).ready( function () {
            $('#myTable').DataTable();
            } );
</script>   

</body>

</html>
