<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

     <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('style')

    <link href="{{ url('css/dashboard.css') }}" rel="stylesheet">


    <title>Console mgmt</title>
</head>
<body>

    <header class="navbar navbar-expand-lg navbar-dark bg-dark p-10"> 
        <div class="container-fluid">
        <a class="navbar-brand" href="/">Serveur Management</a>
        <div class="d-flex text-white">
            <a href="#" class="btn text-white"><i class="fa fa-fw fa-sign-out"></i> Deconnexion</a>
        </div>
    </div>
    </header>
    
    <div class="wrapper">

        <!-- Sidebar -->
        <nav id="sidebar" class="navbar-expand-lg">
            <div class="sidebar-header" id="sidebar_img">
                <img class="rounded-circle" alt="100x100" src="{{asset('images/profile.jpg')}}" data-holder-rendered="true">
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="list-unstyled components">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('user.home')}}"> <i class="fa fa-home"></i> Accueil <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.clients') }}"> <i class="fa fa-users"></i> Clients</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.fichiers') }}"> <i class="fa fa-folder"></i> Fichiers</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.alerts') }}"> <i class="fa fa-exclamation-triangle text-danger"></i> Alerts</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"> <i class="fa fa-cog"></i> Config</a>
                    </li>
                </ul>
            </div>
            
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- We'll fill this with dummy content -->
            
            @yield('content')
            
        </div>

    </div>  

    





</body>
</html>