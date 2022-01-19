



<section class="bg-white border border-dark rounded my-5">
    <table class="table table-hover">
        <h4 class="px-2 py-3 bg-black text-white rounded"> Afficher les fichiers de Alerts !  </h4>
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col"> {{ __('Nom d\'entreprise')}} </th>
                <th scope="col"> {{ __('Responsable')}} </th>
                <th scope="col"> {{ __('Mobile')}} </th>
                <th scope="col"> {{ __('Email')}} </th>
                <th scope="col"> {{ __('Site')}} </th>
                <th scope="col"> {{ __('Fichier')}} </th>
                <th scope="col"> {{ __('chemin de fichier')}} </th>
                <th scope="col"> Date d'alert </th>
                @if( Auth::check())
                <th scope="col"> {{ __('Gérer')}} </th>
                @endif
            </tr>
            </thead>


            <tbody>
                @foreach ($alerts as $alert )
                <tr class="table-danger">
                    <td> {{ $alert->fichier->client->nom_entreprise }} </td>
                    <td> {{ $alert->fichier->client->nom_client }} </td>
                    <td> <a href="tel:{{$alert->fichier->mobile}}" class="text-decoration-none"> {{ $alert->fichier->client->mobile }} </a></td>
                    <td> <a href="mailto:{{$alert->fichier->email}}" class="text-decoration-none"> {{ $alert->fichier->client->email }} </a></td>
                    <td> {{ $alert->fichier->client->site }} </td>
                    <td> {{ $alert->fichier->nom_de_fichier}} </td>
                    <td> {{ $alert->fichier->Chemin_de_fichier}} </td>
                    <td> {{ $alert->created_at}} </td>

                    @if( Auth::check())
                    <td>
                        <form action="{{ route('user.alert-gerer') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$alert->id}}">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Oui </button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        @if($alerts instanceof \Illuminate\Pagination\LengthAwarePaginator )
        <div class="d-flex justify-content-center my-4">
            {!! $alerts->links() !!}
        </div>
        @endif

</section>
