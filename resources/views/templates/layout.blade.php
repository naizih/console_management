<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Serveur Management</title>

      
      <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      @yield('style')
      
  </head>
  <body class="container">
    
    <!-- header pour utiliser en future -->
    <header> </header>
    
    <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-4 p-2 rounded">
      <a class="navbar-brand" href="/">Serveur Management</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/"> Accueil <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Config</a>
          </li>
        </ul>
      </div>
    </nav>

    
    @yield('content')


    
    <footer class="pt-1">
    @yield('footer')
    </footer>
  </body>
</html>


















<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
    @yield('style')

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    
</head>
<body>
    <div id="app">
        <!--<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm ">-->
            <nav class="navbar navbar-expand-md navbar-light">

            <div class="container">
              <a class="navbar-brand" href="{{ url('/user/home') }}">
                {{ config('app.name', 'Dashboard') }}
              </a>

               

    <div class="collapse navbar-collapse" id="toggleMobileMenu">

               <div class="navbar-nav">
                   <a class="nav-link" aria-current="page" href="{{ route('user.books') }}"> {{ __('Books') }} </a>
               </div>

               <div class="navbar-nav">
                   <a class="nav-link" aria-current="page" href="{{ route('user.articles') }}"> {{ __('Articles') }} </a>
               </div>

                <ul class="navbar-nav">
                @if (Auth::user())
                

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('user.addbook') }}"> {{ __('Add Book') }} </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('user.addarticle') }}"> {{ __('Add Article') }} </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('user.school_books') }}"> {{ __('School Textbooks') }}  </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-danger rounded" aria-current="page" href="{{ route('donation.donate') }}"> {{ __('Donate') }}  &nbsp; <i class="fa fa-heart"></i> </a>
                    </li>
                @endif
                </ul>

                <!--
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                -->

                <!--<div class="collapse navbar-collapse" id="navbarSupportedContent">-->
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                                        {{ __('Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="#">
                                        {{ __('Setting') }}
                                    </a>

                                    <hr class="my-1">
                                    <a class="dropdown-item" href="{{ route('user.change_password') }}">
                                        {{ __('Change password') }}
                                    </a>


                                    <a class="dropdown-item" href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
</div>

        </nav>

      
        <main class="py-3" style="min-height: 70vh;">
            @yield('content')
        </main>
    </div>




    <!-- Footer -->



    @yield('script')

</body>
</html>