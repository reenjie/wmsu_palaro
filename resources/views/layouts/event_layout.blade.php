@guest
    <script>
        window.location.href = '/';
    </script>
@else
    @if (Auth::user()->user_type == 'ecoordinator')
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
    @vite(['resources/css/app.css', 'resources/css/admin.css', '../../node_modules/bootstrap/dist/css/bootstrap.css', '../../node_modules/bootstrap/dist/js/bootstrap.bundle.js'])
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

                    @if (Auth::check())
                        {{ Auth::user()->name }}
                    @endif
                    <span id="username" class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    </span>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="font-size: 13px;">
                        <li><a class="dropdown-item" href="{{ route('e.profile') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.logout') }} ">Logout</a></li>

                    </ul>
                </div>

                <span style="font-weight: normal;font-size: 12px">
                    @if (Auth::check())
                        {{ Auth::user()->email }}
                    @endif
                </span>

            </div>
            <br>
            <div class="navigations">



                <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="font-size: 14px">




                    <div class="sidebar-heading text-danger" style="font-size: 10px">
                        REPORTS
                    </div>

                    <li class="nav-item navitems">
                        <a class="nav-link navlinks " href="{{ route('e.dashboard') }}">
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
                        <a class="nav-link navlinks  " href="{{ route('e.announcement') }}">
                            <i class="fas fa-info-circle"></i>
                            <span>Announcement</span></a>
                    </li>

                    <li class="nav-item navitems ">
                        <a class="nav-link navlinks " href="{{ route('e.homepage') }}">
                            <i class="fas fa-home"></i>
                            <span class="position-relative">Homepage


                            </span>

                        </a>

                    </li>

                    <li class="nav-item navitems">
                        <a class="nav-link navlinks  " href="{{ route('e.media') }}">
                            <i class="fas fa-link"></i>
                            <span>Media</span></a>
                    </li>

                    <li class="nav-item navitems">
                        <a class="nav-link navlinks  " href="{{ route('e.sportevents') }}">
                            <i class="fas fa-list-ul"></i>
                            <span>
                                @foreach ($myevent as $myE)
                                    {{ $myE->name }}
                                @endforeach
                            </span></a>
                    </li>



                    <li class="nav-item navitems">
                        <a class="nav-link navlinks  " href="{{ route('e.team') }}">
                            <i class="fas fa-people-group"></i>
                            <span>TEAMS</span></a>
                    </li>




                    <li class="nav-item navitems ">
                        <a class="nav-link navlinks " href="{{ route('e.participants') }}">
                            <i class="fas fa-users-cog"></i>
                            <span class="position-relative">Participants
                                @isset($count)
                                    @if ($count >= 1)
                                        <span class="badge bg-danger">{{ $count }}</span>
                                    @endif
                                @endisset
                            </span>

                        </a>

                    </li>

                    <li class="nav-item navitems ">
                        <a class="nav-link navlinks " href="{{ route('e.tally') }}">
                            <i class="fas fa-chart-line"></i>
                            <span class="position-relative">TALLY

                            </span>

                        </a>

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


            <h6 class="text-primary text-light hf " id="abtext">
                {{-- @foreach ($college as $mycollege)
                        {{$mycollege->name}}
            @endforeach --}}

                <span style="font-weight: bolder">
                    @foreach ($myevent as $myE)
                        {{ $myE->name }}
                    @endforeach
                </span>


            </h6>

        </div>

        <main class="py-4 ">
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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css" />

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (Auth::user()->fl == 0)
        <button type="button" id="btnfirstlogin" class="btn d-none btn-primary" data-bs-toggle="modal"
            data-bs-target="#firstlogin">
            asd
        </button>


        <div class="modal fade" id="firstlogin" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title hf" id="exampleModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-secondary af">We have Notice that this is your first Login . Please Change your
                            password..</h6>

                        <h6 class="text-secondary">
                            New Password
                        </h6>
                        <input type="password" class="form-control" id="np" autocomplete="off">
                        <div class="invalid-feedback" id="npfeed"></div>
                        <h6 class="text-secondary">
                            Confirm Password
                        </h6>
                        <input type="password" class="form-control" id="cp">
                        <div class="invalid-feedback" id="cpfeed"></div>

                        <button class="btn btn-primary  mt-3" id="sc">Save Changes</button>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $('#btnfirstlogin').click();

                $('#sc').click(function() {
                    var np = $('#np').val();
                    var cp = $('#cp').val();

                    if (np == '') {
                        $('#np').addClass('is-invalid');
                        $('#npfeed').html(
                            '<span class="text-danger" style="font-size:13px">Please input new Password</span>'
                        );

                    } else if (cp == '') {
                        $('#cp').addClass('is-invalid');
                        $('#cpfeed').html(
                            '<span class="text-danger" style="font-size:13px">Please Confirm your New Password</span>'
                        );
                    } else if (np != cp) {
                        $('#cp').addClass('is-invalid');
                        $('#cpfeed').html(
                            '<span class="text-danger" style="font-size:13px">Password Does not Match!</span>'
                        );
                    } else {

                        $.ajax({
                            url: '{{ route('coordinator.firslogin') }}',
                            method: 'get',
                            data: {
                                newpass: np
                            },
                            success: function(data) {
                                swal("Successful", "Password Changed Successfully!", "success");
                                $('#firstlogin').modal('hide');
                            }
                        })


                    }
                })

                $('#np').keyup(function() {
                    $(this).removeClass('is-invalid');

                })
                $('#cp').keyup(function() {
                    $(this).removeClass('is-invalid');
                    var np = $('#np').val();
                    var cp = $(this).val();

                    if (np != cp) {
                        $(this).addClass('is-invalid');
                        $('#cpfeed').html(
                            '<span class="text-danger" style="font-size:13px">Password Does not Match!</span>'
                        );
                    } else {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                        $('#cpfeed').html(
                            '<span class="text-success" style="font-size:13px">Password Match</span>');
                    }




                })
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('#myTable1').DataTable();
        });
    </script>

</body>

</html>
