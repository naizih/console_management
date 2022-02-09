

@extends('templates.dashboard')

@section('content')




<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="mb-5">
                <h2 class="text-center text-3xl font-extrabold text-gray-900">Create Email Configuration</h2>
            </div>
            
            <form action="{{route('user.emailconfiguration_store')}}" method="post">
                @csrf

                        
                <div class="form-group row mb-4 shadow-sm -space-y-px">
                    <label for="inputDriver" class="col-sm-3 col-form-label">Driver</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="driver" id="inputDriver" placeholder="Driver" value="{{old('driver')}}">
                              
                        @error('driver')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>

                        

                <div class="form-group row  mb-4 shadow-sm -space-y-px">
                    <label for="inputHost" class="col-sm-3 col-form-label">Host</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="hostName" id="inputHost" placeholder="Host" value="{{old('hostName')}}">
                        @error('hostName')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row  mb-4 shadow-sm -space-y-px">
                    <label for="inputPort" class="col-sm-3 col-form-label">Port</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="port" id="inputPort" placeholder="Port" value="{{old('port')}}">
                        @error('port')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row  mb-4 shadow-sm -space-y-px">
                    <label for="inputConfirmPassword" class="col-sm-3 col-form-label"> Encryption </label>
                    <div class="col-sm-9">
                        <select name="encryption" id="encryption" class="form-select">
                            <option value="{{old('encryption')}}"> {{old('encryption')}} </option>
                            <option value="TLS"> TLS </option>
                        </select>
                        @error('encryption')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row  mb-4 shadow-sm -space-y-px">
                    <label for="inputusername" class="col-sm-3 col-form-label">User Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="userName" id="inputusername" placeholder="User Name" value="{{old('userName')}}">
                        @error('userName')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="form-group row  mb-4 shadow-sm -space-y-px">
                    <label for="inputpassword" class="col-sm-3 col-form-label"> Password </label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" id="inputpassword" placeholder="Password" value="{{old('password')}}">
                        @error('password')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row  mb-4 shadow-sm -space-y-px">
                    <label for="inputPort" class="col-sm-3 col-form-label"> Sender Name </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="senderName" id="inputPort" placeholder="Sender Name" value="{{old('senderName')}}">
                        @error('senderName')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row  mb-4 shadow-sm -space-y-px">
                    <label for="inputPort" class="col-sm-3 col-form-label"> Sender Email </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="senderEmail" id="inputPort" placeholder="Sender Email" value="{{old('senderEmail')}}">
                        @error('senderEmail')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success"> Sauvegarde </button>
                    </div>
                </div>

            </form>   
        </div>
    </div>
</div>



@endsection