
<ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ Route::current()->getName() == 'user.clients' ? 'text-white bg-dark' : '' }} text-dark" aria-controls="home" href="{{route('user.clients')}}" role="tab" data-toggle="tab"> {{ __('Accueil Client')}} </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::current()->getName() == 'user.clients-accepter' ? 'text-white bg-dark' : '' }} text-dark" aria-controls="accepter" href="{{route('user.clients-accepter')}}" role="tab" data-toggle="tab"> {{ __('Clients Accepter')}} </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::current()->getName() == 'user.clients-rejeter' ? 'text-white bg-dark' : '' }} text-dark" aria-controls="rejeter" href="{{ route('user.clients-rejeter') }}" role="tab" data-toggle="tab"> {{ __('Clients Rejeter')}} </a>
        </li>
</ul>