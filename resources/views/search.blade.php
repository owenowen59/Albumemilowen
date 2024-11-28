@extends('layout')

@section('contenu')

@if($results)
    <h2>Les résultats de la recherche</h2>
    <ul>
        @foreach($results as $result)
            <li>
                Photo : {{ $result->photo_titre }} - 
                Note : {{ $result->photo_note ?? 'Non notée' }} - 
                URL : <img src="{{ $result->photo_url }}" width= 200px> - 
                Album : {{ $result->album_titre ?? 'Aucun album' }}
            </li>
        @endforeach
    </ul>
@else
    <p>Aucun résultat trouvé.</p>
@endif


@endsection