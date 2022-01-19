
<ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ Route::current()->getName() == 'user.config' ? 'text-white bg-dark' : '' }} text-dark" aria-controls="home" href="#" role="tab" data-toggle="tab"> {{ __('Users')}} </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::current()->getName() == 'user.clients-accepter' ? 'text-white bg-dark' : '' }} text-dark" aria-controls="accepter" href="#" role="tab" data-toggle="tab"> {{ __('Roles')}} </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Route::current()->getName() == 'user.clients-rejeter' ? 'text-white bg-dark' : '' }} text-dark" aria-controls="rejeter" href="#" role="tab" data-toggle="tab"> {{ __('Clients Rejetés')}} </a>
        </li>
</ul>