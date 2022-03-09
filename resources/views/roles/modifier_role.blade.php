@extends('templates.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3> Modifier Role </h3> 
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.role-update', $role->id) }}">
                        @csrf

                        <div class="form-group row mb-2">
                            <label for="inputName" class="col-sm-3 col-form-label">Nom de Role </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="role" id="inputName"  value="{{ $role->name }}">
                              
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
                                <input type="text" class="form-control" name="label" id="inputEmail" value="{{ $role->slug }}">
                                @error('label')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        
                        @if ($role->slug != "admin")
                        <div class="form-group row mb-2">
                            <label for="inputEmail" class="col-sm-3 col-form-label"> Permissions </label>
                            <div class="col-sm-9">
                                
                                @for ($i = 0; $i < count($role->permissions) ; $i++)
                                    @php
                                        $ids[] = $role->permissions[$i]->id 
                                    @endphp
                                @endfor
                               
                                @foreach($permissions as $index => $permission )
                                    <div>
                                        @if ( count($role->permissions) > 0 && in_array($permission->id, $ids))
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
                        @endif


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
