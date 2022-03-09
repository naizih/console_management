@extends('templates.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> 
                    <h3> Enregistrement </h3>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('user.new-user') }}">
                        @csrf

                        
                        <div class="form-group row mb-2">
                            <label for="inputName" class="col-sm-3 col-form-label">Nom</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="inputName" placeholder="Nom" value="{{old('name')}}">
                              
                                @error('name')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-2">
                            <label for="inputEmail" class="col-sm-3 col-form-label">E-mail</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="E-mail" value="{{old('email')}}">
                                @error('email')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
                                @error('password')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="inputConfirmPassword" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password_confirmation" id="inputConfirmPassword" placeholder="Confirm Password">
                                @error('password_confirmation')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-2">
                            <label for="inputConfirmPassword" class="col-sm-3 col-form-label">Role d'utilisateur</label>
                            <div class="col-sm-9">
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value=""> Choisir le Role d'utilisateur </option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}"> {{ $role->name }} </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary"> Register </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
