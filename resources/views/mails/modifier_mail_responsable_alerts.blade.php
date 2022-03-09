

@extends('templates.dashboard')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3> Modifier Information </h3> 
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('user.email-update', $email->id) }}">
                        @csrf

                        
                        <div class="form-group row mb-2">
                            <label for="inputName" class="col-sm-3 col-form-label">Nom  </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nom" id="inputName"  value="{{ $email->name }}">
                              
                                @error('nom')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mb-2">
                            <label for="inputEmail" class="col-sm-3 col-form-label"> E-mail </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" id="inputEmail"  value="{{ $email->email }}">
                                @error('email')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-2">
                            <label for="inputEmail" class="col-sm-3 col-form-label"> Description </label>
                            <div class="col-sm-9">

                                <textarea name="description" id="description" cols="60" rows="5" class="form-control" style="resize: none;"> {{$email->description}} </textarea>
                                @error('description')
                                <div class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>


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