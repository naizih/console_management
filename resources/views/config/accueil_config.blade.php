
@extends('templates.dashboard')

@section('content')
<section>

    <div class="container">

        @if(Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
        @endif

        @if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif
      

        <!-- Include le page tab
        @include('config.tabs')
         -->

         <h2>Config</h2>
         <hr>

        

         @include('users.afficher_utilisateurs')







    </div>
</section>

@endsection
