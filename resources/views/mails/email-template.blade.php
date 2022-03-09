
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
    <title>Email Template</title>
</head>
<body>

    <div class="container">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <div class="min-h-screen flex justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
                        <div class="max-w-md w-full space-y-8">
                            <h2> {{$data['title']}} </h2>
                        </div>

                        <div class="max-w-md w-full space-y-8">
                            <p> 
                                {{$data['body']}} <br>

                                @if(isset($data['file']))
                                Nom de fichier : {{ $data['file']}} <br>
                                @endif
                                
                                @if (isset($data['client']))
                                Nom de client : {{ $data['client']}} <br>
                                @endif
                                
                                @if (isset($data['client_email']))
                                    Mail de client : <a href="mailto:{{ $data['client_email']}}"> {{ $data['client_email']}} </a> <br>
                                @endif
                                
                                @if (isset($data['mobile']))
                                    Mobile de client :  <a href="tel:{{ $data['mobile']}}"> {{ $data['mobile']}} </a> <br>
                                @endif
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
