<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WMSU-PALARO</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Fonts -->

    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/mobile.css')}}">
   



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body id="body">
    <div id="wrapper"></div>
    <button id="btnup" class="d-none "><i class="fas fa-caret-up"></i></button>
    <nav class="nav1 shadow">

        <div class="container-fluid">
            <div class="Sidelink">
                <a href="/login" class="hf fs">SignIn</a>
            </div>
        </div>
    </nav>
    <nav class="nav2" id="nav2">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="container row">
                    <div class="col-md-6 mt-3">
                        <a class="navbar-brand logo hf" href="/">
                            <img src="{{ asset('assets/img/wmsu.jpg') }}" class="rounded-circle" alt="">
                            
                            <span id="text-wmsu" style="text-transform: uppercase">Western Mindanao State University</span>
                        </a>
                    </div>
                    <div class="col-md-6 mt-3">
                        @isset($hidenav)
                        @else
                            <div class="navs">
                                <a href="/">Home</a>
                                <a href="#Events">Events</a>
                                <a href="#Media">Media</a>
                                <a href="#Announcement">Announcement</a>
                                <a href="">About</a>
        
                            </div>
                        @endisset
        
                        @if (Auth::check())
                        
                            <div class="dropdown" id="Options">
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span style="font-weight: bold">{{ Auth::user()->name }}</span>
                                    @isset($count)
                                        @if ($count >= 1)
                                            <span class="badge bg-danger rounded-pill text-bg-danger">{{ $count }}</span>
                                        @endif
                                    @endisset
                                    <br>
                                    <span style="font-size:13px">Profile</span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @if (Auth::user()->user_type == 'superadmin')
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        
                                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}">MyProfile</a></li>
                                    @elseif(Auth::user()->user_type == 'ecoordinator')
                                        <li><a class="dropdown-item" href="{{ route('e.dashboard') }}">Dashboard</a></li>
        
                                        <li><a class="dropdown-item" href="{{ route('e.profile') }}">MyProfile</a></li>
                                    @elseif(Auth::user()->user_type == 'coordinator')
                                        <li><a class="dropdown-item" href="{{ route('coordinator.dashboard') }}">Dashboard</a>
                                        </li>
                                        @isset($count)
                                            @if ($count >= 1)
                                                <li>
                                                    <a href="{{ route('coordinator.participants') }}" class="dropdown-item">
                                                        <span class="position-relative">Participants
        
        
        
                                                            <span
                                                                class="badge bg-danger rounded-pill text-bg-danger">{{ $count }}</span>
        
        
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endisset
        
                                        <li><a class="dropdown-item"
                                                href="{{ route('coordinator.announcement') }}">Announcement</a></li>
                                    @endif
        
        
                                    <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                                </ul>
                            </div>
                        @else
                        @endif
        
                        <button class="" id="btn-open-canvas" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                            <i class="fas fa-bars"></i>
                        </button>
        
                    </div>
        
        
        
                </div> 
            </div>
            <div class="col-md-1"></div>
        </div>
       
    </nav>



    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">

            <button type="button" style="position: absolute;right:20px;top:20px" class="btn-close"
                data-bs-dismiss="offcanvas" aria-label="Close"></button>
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

  
    @isset($join)

    @else 
    <footer>
        <h6>CopyRights &middot; 2022 | WMSU-PALARO</h6>
    </footer>
    @endisset
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var navs = $('.navs').html();
            var logo = $('.logo').html();
            $('#navmobile').html(navs);
            $('#offcanvasExampleLabel').html(logo);
        })

        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            var revealc = document.querySelectorAll(".revealc");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");

                } else {
                    reveals[i].classList.remove("active");
                }
            }

            for (var i = 0; i < revealc.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = revealc[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    revealc[i].classList.add("active");

                } else {
                    revealc[i].classList.remove("active");
                }
            }
        }

        window.addEventListener("scroll", reveal);

        // To check the scroll position on page load
        reveal();

        $(".navs a").click(function(event) {
            event.preventDefault();
            $("html, body").animate({
                scrollTop: $($(this).attr("href")).offset().top
            }, 900);
        });
        $('#home').click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 1000);
        })
    </script>


</body>

</html>
