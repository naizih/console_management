<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Console Management') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ url('css/dashboard.css') }}" rel="stylesheet">
    @yield('style')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body id="body">

    <header class="navbar navbar-expand-lg navbar-dark bg-dark p-10">
        <div class="container-fluid">
            
            @if (Auth::user())
                <a class="navbar-brand" href="/"> Utilisateur {{ Auth::user()->name }} </a>
            @else
                <a class="navbar-brand" href="/">Serveur Management </a>
            @endif

            @guest
                @if (Route::has('login'))
                    <div class="d-flex text-white">
                        <a href="{{ route('login') }}" class="btn text-white"><i class="fa fa-fw fa-sign-in"></i> Login</a>
                    </div>
                    @endif
            @else
                <div class="d-flex text-white">
                    <a form="logout-form" href="{{ route('user.logout') }}" class="btn text-white" 
                            onclick="event.preventDefault(); 
                            document.getElementById('logout-form').submit();"> 
                        <i class="fa fa-fw fa-sign-out"></i> 
                        {{ __('Logout')}}
                    </a>
                </div>

                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                    @csrf

                </form>
            @endguest
        </div>
    </header>
    
    <div class="wrapper">

        <!-- Sidebar -->
        @if (Auth::user())
        <nav id="sidebar" class="navbar-expand-lg">
            <div class="sidebar-header" id="sidebar_img">
                <!--<img class="rounded-circle" alt="100x100" src="{{asset('images/profile.jpg')}}" data-holder-rendered="true">-->
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="list-unstyled components">
                    <li class="nav-item active">
                        <a class="nav-link {{ Route::current()->getName() == 'user.home' ? 'text-white bg-dark' : '' }} text-white" aria-controls="home" href="{{route('user.home')}}" role="tab" data-toggle="tab"><i class="fa fa-home"></i> Accueil </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link {{ Route::current()->getName() == 'user.clients' ? 'text-white bg-dark' : '' }} text-white" aria-controls="home" href="{{route('user.clients')}}" role="tab" data-toggle="tab"><i class="fa fa-users"></i> Clients </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ Route::current()->getName() == 'user.fichiers' ? 'text-white bg-dark' : '' }} text-white" aria-controls="home" href="{{route('user.fichiers')}}" role="tab" data-toggle="tab"><i class="fa fa-folder"></i> Fichiers </a>
                        <!--<a class="nav-link" href="{{ route('user.fichiers') }}"> <i class="fa fa-folder"></i> Fichiers</a>-->
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ Route::current()->getName() == 'user.alerts' ? 'text-white bg-dark' : '' }} text-white" aria-controls="home" href="{{route('user.alerts')}}" role="tab" data-toggle="tab"><i class="fa fa-exclamation-triangle text-danger"></i> Alertes </a>
                        <!--<a class="nav-link" href="{{ route('user.alerts') }}"> <i class="fa fa-exclamation-triangle text-danger"></i> Alerts</a>-->
                    </li>

                    @if (Auth::user()->is_admin == 1)
                    <li class="nav-item">
                        <a class="nav-link {{ Route::current()->getName() == 'user.config' ? 'text-white bg-dark' : '' }} text-white" aria-controls="home" href="{{route('user.config')}}" role="tab" data-toggle="tab"><i class="fa fa-cog"></i> Config </a>   
                    </li>
                    @endif

                </ul>
            </div>
        </nav>
        @endif

        <!-- Page Content -->
        <div id="content">
            <!-- We'll fill this with dummy content -->
<!--
            @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
            @endif

-->

            @if(\Session::get('message'))
            <div class="alert alert-success">
                <p> {{session::get('message')}}</p>
            </div>
            @endif

            @yield('content')
            
        </div>

    </div>  
</body>
</html>