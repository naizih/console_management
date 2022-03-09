


@extends('templates.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Modifier utilisateur </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.user_update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">

                        <div class="form-group row mb-2">
                            <label for="inputName" class="col-sm-3 col-form-label">Nom</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="inputName" placeholder="Nom" value="{{ $user->name }}">
                              
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
                                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="E-mail" value="{{ $user->email }}">
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
                            <label for="inputRole" class="col-sm-3 col-form-label">Role d'utilisateur</label>
                            <div class="col-sm-9">
                                <select name="role_id" id="inputRole" class="form-select">
                                    <option value="{{$user->role_id}}">{{$user->role->name}}</option>
                                    @foreach($roles as $role )
                                        @if($role->name != $user->role->name)
                                            <option value="{{$role->id}}">{{$role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('role_id')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>


                        <!--
                        <div class="form-group row mb-2">
                            <label for="inputRole" class="col-sm-3 col-form-label">Permissions d'utilisateur</label>
                            <div class="col-sm-9">

                                <-- Add all user permissions id to an array  --
                                @for ($i = 0; $i < count($user->role->permissions) ; $i++)
                                    @php
                                        $ids[] = $user->role->permissions[$i]->id 
                                    @endphp
                                @endfor
                               

                                @foreach($permissions as $index => $permission )
                                    <div>
                                        @if ( count($user->role->permissions) > 0 && in_array($permission->id, $ids))
                                        <input type="checkbox" id="permissions" value="{{$permission->id}}" name="permissions[]" checked>                                        
                                        <label for="permissions"> {{ $permission->name }} </label>
                                        @else
                                        <input type="checkbox" id="permissions" value="{{$permission->id}}" name="permissions[]">                                        
                                        <label for="permissions"> {{ $permission->name }} </label>
                                        @endif
                                    </div>
                                @endforeach                                
                                
                                @error('permissions')
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
