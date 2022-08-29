<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WMSU-PALARO</title>

    @vite([
        'resources/css/app.css',
        'resources/css/auth.css',
        'resources/js/app.js',
        '../../node_modules/bootstrap/dist/css/bootstrap.css',
        '../../node_modules/bootstrap/dist/js/bootstrap.bundle.js',
    ])
  
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

 
</head>
<body>
    
    <div id="app">
       
        
    {{--     <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand hf" href="{{ url('/') }}">
                  Home
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
      
        <div class="row">
    
            <div class="col-md-5" id="leftlayout">
              
                @yield('content')
            </div>
            <div class="col-md-7" id="rightlayout">
                <img src="{{asset('assets/img/wmsu.jpg')}}" class="rounded-circle" alt="">
                <h5 class="">WMSU-PALARO
                    <br>
                    <span style="font-size:18px">{{date('Y')-1}}-{{date('Y')}}</span>

                </h5>
               

            </div>
        </div>
        
        <main class="py-4">
            <h6 class="hf" id="copyrights">CopyRights &middot; 2022 | WMSU-PALARO</h6>  
            <a href="/" id="homelink" class="hf">Home</a>
        </main>
    </div>
</body>
</html>
