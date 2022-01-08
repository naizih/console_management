
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
      




        <h1> Config</h1>
        <hr>

        


    </div>
</section>

@endsection
