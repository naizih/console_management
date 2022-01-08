



<section class="bg-white border border-dark rounded my-5">
    <table class="table">
        <h4 class="px-2 py-3 bg-black text-white rounded"> Nouveau utilisateur est crée, voulez-vous l'autorisé pour recevoir l'information de fichiers appat de ce client ?</h4>
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col"> {{ __('Nom d\'entreprise')}} </th>
                <th scope="col"> {{ __('Nom de client')}} </th>
                <th scope="col"> {{ __('Mobile')}} </th>
                <th scope="col"> {{ __('Email')}} </th>
                <th scope="col"> {{ __('Site')}} </th>
                <th scope="col"> {{ __('Actions')}} </th>
        </thead>

        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td> {{ $client->nom_entreprise }} </td>
                    <td> {{ $client->nom_client }} </td>
                    <td> {{ $client->mobile }} </td>
                    <td> {{ $client->email }} </td>
                    <td> {{ $client->site }} </td>
                    <td>
                        <form id="form-accept-deny" action="{{ route('user.user-request') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $client->id }}">
                            <button class="btn btn-success" name="send" value="accept"><i class="fa fa-check"></i> Accepter </button> 
                            <button class="btn btn-danger" name="send" value="deny"><i class="fa fa-times"></i> Rejeté </button> 
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    @if($clients instanceof \Illuminate\Pagination\LengthAwarePaginator )
    <div class="d-flex justify-content-center my-4">
        {!! $clients->links() !!}
    </div>
    @endif

</section>


