@if (Auth::check())
    @if (Auth::user()->user_type == 'superadmin')
    @else
        <script>
            window.location.href = '/';
        </script>
    @endif
@else
    <script>
        window.location.href = '/';
    </script>
@endif
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin-Palaro_CMS</title>

    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/css/admin.css',
        '../../node_modules/bootstrap/dist/css/bootstrap.css',
        '../../node_modules/bootstrap/dist/js/bootstrap.bundle.js',
    ])
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
                        <li><a class="dropdown-item" href="{{route('admin.profile')}}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.logout') }} ">Logout</a></li>

                    </ul>
                </div>

                <span style="font-weight: normal;font-size: 12px">  @if(Auth::check())   {{ Auth::user()->email }} @endif</span>

            </div>
          <br>
            <div class="navigations">



                <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="font-size: 14px">




                    <div class="sidebar-heading text-danger" style="font-size: 10px">
                        REPORTS
                    </div>

                    <li class="nav-item navitems">
                  <a class="nav-link navlinks " href="{{route('admin.dashboard')}}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>





                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading text-danger" style="font-size: 10px">
                        MANAGE
                    </div>

                    <li class="nav-item navitems">
                        <a class="nav-link navlinks  " href="{{route('admin.homepage')}}">
                            <i class="fas fa-home"></i>
                            <span>HomePage</span></a>
                    </li>

                    <li class="nav-item navitems">
                        <a class="nav-link navlinks  " href="{{route('admin.colleges')}}">
                            <i class="fas fa-graduation-cap"></i>
                            <span>Colleges</span></a>
                    </li>

                    <li class="nav-item navitems">
                        <a class="nav-link navlinks  " href="{{route('admin.coordinators')}}">
                            <i class="fas fa-list-ul"></i>
                            <span>Coordinators</span></a>
                    </li>

                    <li class="nav-item navitems">
                        <a class="nav-link navlinks " href="{{route('admin.students')}}">
                            <i class="fas fa-users"></i>
                            <span>Students</span></a>
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
