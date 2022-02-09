@extends('templates.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3> Ajouter Role </h3> 
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('user.new-role') }}">
                        @csrf

                        
                        <div class="form-group row mb-2">
                            <label for="inputName" class="col-sm-3 col-form-label">Nom de Role </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="role" id="inputName" placeholder="Nom de role" value="{{old('role')}}">
                              
                                @error('role')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-2">
                            <label for="inputEmail" class="col-sm-3 col-form-label"> Label </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="label" id="inputEmail" placeholder="Label de role" value="{{old('label')}}">
                                @error('label')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-2">
                            <label for="inputEmail" class="col-sm-3 col-form-label"> Permissions </label>
                            <div class="col-sm-9">
                                
                                @foreach ($permissions as $permission )
                                <div>
                                    <input type="checkbox" id="permission" value="{{$permission->id}}" name="permissions[]">                                        
                                    <label for="permissions"> {{ $permission->name }} </label>
                                </div>
                                @endforeach
                                
                                @error('permissions')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mt-4">
                            <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary"> Ajouter </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
