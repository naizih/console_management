



@extends('templates.dashboard')

@section('content')



<div class="card">
        <div class="card-header">
            <h3> Envoyer le Mail automatique en cas d'alertes </h3>
        </div>


        <div class="card-body">
            <div class="card-title">
            <a href="{{route('user.create-email')}}" class="btn btn-success"> Ajouter email </a>

            </div>
            
            <table class="table table-bordered table-striped">
                <thead class="align-middle bg-dark text-white">
                    <tr>
                        <th scope="col"> # </th>
                        <th scope="col"> Nom </th>                        
                        <th scope="col"> E-Mail </th>
                        <th scope="col"> Descritpion </th>
                        <th scope="col"> Action </th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emails as $index => $email)
                        <tr>
                            <td> {{$index+1}} </td>
                            <td> {{ $email->name }} </td>
                            <td> {{ $email->email }} </td>
                            <td> {{ $email->description }} </td>
                            <td class="text-center">
                        
                        <div class="btn-group">
                            <a href="{{route('user.edit-email', $email->id )}}" class="btn btn-primary rounded mx-1"> <i class="fa fa-edit"></i> Modifier </a>

                            <form id="rejeter-form" action="{{ route('user.delete-email' , $email->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $email->id }}">
                                <button class="btn btn-danger" ><i class="fa fa-trash"></i> Supprimer </button> 
                            </form>
                        </div>
                    </td>


                        </tr>
                    @endforeach
                
                </tbody>  
            </table>

        </div>
    </div>

@endsection