

  <!-- sidebar-wrapper  -->
  <!--
  <header class="container-fluid bg-dark p-3">
        <div class="d-flex justify-content-between">
          <div class="mx-4">
              <a class="navbar-brand text-white" href="/"> Console Management </a>
            </div>
        <div>
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
                        <i class="fa fa-sign-out-alt"></i> 
                        {{ __('Logout')}}
                    </a>
                </div>

                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
        @endguest
    </header>
    -->

    
    @if (!Auth::user())
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark bg-black mt-1 p-2">
        <!-- <a class="navbar-brand" href="/">Cryptolocker</a>-->
        <img src="{{url('images/L.Koesio_50mm_CMJN.svg')}}" class="navbar navbar-brand" alt="" srcset="" id="logo">

          @if (Route::has('register'))
            <div class="nav-item">
              <a class="btn text-white" href="{{ route('register') }}"> S'inscrire </a>
            </div>
          @else
          <div class="nav-item">
              <a href="{{ route('user.home') }}" class="btn text-white"><i class="fa fa-fw fa-sign-in"></i> Se connecter </a>
            </div>
          @endif
        
      </nav>
    </div>
    @endif

  @if (Auth::user())
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="{{ route('user.home') }}">
          <img src="{{url('images/L.Koesio_50mm_CMJN.svg')}}" class="navbar navbar-brand" alt="" srcset="" id="logo_dashboard">
        </a>
        <!--<a href="{{ route('user.home') }}">Console Management </a>-->
        
        <!-- <div id="close-sidebar"> <i class="fas fa-sign-out-alt"></i> </div> -->
      </div>
      <div class="sidebar-header">
        <div class="user-info">
          <span class="user-name">
            @if (Auth::user())
                <strong> {{ Auth::user()->name }} </strong>
            @endif

          </span>
          <span class="user-role"> {{ Auth::user()->role->name}} </span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
      </div>



      <div class="sidebar-menu">
        <ul>
          <li class="header-menu"> <span>General</span> </li>

          <li> <a href="{{route('user.home')}}"> <i class="fa fa-home"></i> <span>Accueil</span> </a> </li>
          
          <li class="sidebar-dropdown">
            <a href="#"> <i class="fa fa-users"></i> <span>Clients</span>  </a>
            <div class="sidebar-submenu">
              <ul>
                <li> <a href="{{route('user.clients')}}">Tous les clients </a> </li>
                <li> <a href="{{ route('user.clients-accepter') }}"> Clients acceptés </a> </li>
                <li> <a href="{{ route('user.clients-rejeter') }}"> Clients rejetés </a> </li>
              </ul>
            </div>
          </li>

          <li> <a href="{{ route('user.fichiers') }}"> <i class="fa fa-folder"></i> <span> Fichiers</span> </a></li>
          <li> <a href="{{ route('user.alerts') }}"> <i class="fa fa-exclamation-triangle"></i> <span> Alerts </span> </a></li>

          
          @can('user_management_button', App\Models\User::class)
          <li class="sidebar-dropdown">
            <a href="#"> <i class="fa fa-users"></i> <span>Gestion des utilisateurs </span>  </a>
            <div class="sidebar-submenu">
              <ul>

                @can('crud_utilisateurs', App\Models\User::class)
                  <li> <a href="{{route('user.users')}}"> Utilisateurs </a> </li>
                @endcan
                
                @can('crud_roles', App\Models\User::class)
                  <li> <a href="{{ route('user.roles') }}"> Roles </a> </li>
                @endcan

                @can('crud_permissions', App\Models\User::class)
                  <li> <a href="{{ route('user.permissions') }}"> Permissions  </a> </li>
                @endcan

              </ul>
            </div>
          </li>
          @endcan


          @can('crud_emails', App\Models\User::class)
            <li> <a href="{{route('user.mails')}}"> <i class="fa fa-envelope"></i> Gestion Mail </a> </li>
          @endcan


          @can('user_configuration_button', App\Models\User::class)
          <li class="sidebar-dropdown">
            <a href="#"> <i class="fa fa-cog"></i> <span> Configuration </span>  </a>
            <div class="sidebar-submenu">
              <ul>
                @can('crud_emails', App\Models\User::class)
                  <li> <a href="{{route('user.email-configuration-index')}}"> E-mail Configuration </a> </li>
                @endcan
              </ul>
            </div>
          </li>
          @endcan



          <!--
          <li class="header-menu"> <span>Extra</span> </li>
          <li> <a href="#"> <i class="fa fa-book"></i> <span>Documentation</span> <span class="badge badge-pill badge-primary">Beta</span> </a> </li>
          -->
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->

    <div class="sidebar-footer">
      <!--
      <a href="#"> <i class="fa fa-bell"></i> <span class="badge badge-pill badge-warning notification">3</span> </a>
      -->
      <a href="{{route('user.mails')}}"> <i class="fa fa-envelope"></i> <span class="badge badge-pill badge-success notification"> </span> </a>
      <a href="{{route('user.email-configuration-index')}}"> <i class="fa fa-cog"></i> <span class="badge-sonar"></span> </a>
  
      <!-- Logout -->
      <a form="logout-form" href="{{ route('user.logout') }}" 
              onclick="event.preventDefault(); 
              document.getElementById('logout-form').submit();"> 
              <i class="fa fa-sign-out-alt"></i> 
      </a>

      <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
        @csrf
      </form>
      <!-- End logout  -->

    </div>
  </nav>
@endif




