@extends('templates.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3> Ajouter permission </h3> 
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.permission-update', $permission->id) }}">
                        @csrf

                        <div class="form-group row mb-2">
                            <label for="inputName" class="col-sm-3 col-form-label">Nom de permission </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nom_permission" id="inputName"  value="{{ $permission->name }}">
                              
                                @error('nom_permission')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        
                        <!--

                        <div class="form-group row mb-2">
                            <label for="inputEmail" class="col-sm-3 col-form-label"> Label </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="label" id="inputEmail" value="{{ $permission->slug }}">
                                @error('label')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>
                        -->

                        <div class="form-group row mt-4">
                            <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary"> Modifier </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
