@extends('layout')

@section('contenu')

<head>
<link rel="stylesheet" type="text/css" href="{{asset('/css/search.css')}}"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet" >
</head>

@if($results)

<section> 

        <h1 class="titre-connexion">RÉSULTATS</h1>
        <h1 class="titre-2">DES RECHERCHES</h1>



        <div class="search-results-container">
            <ul class="search-results-list">
                @foreach($results as $result)
                    <li class="search-result-item">
                        <div class="result-content">
                            <div class="result-text">
                                <h3 class="result-title">Photo : {{ $result->photo_titre }}</h3>
                                <p class="result-note">Note : {{ $result->photo_note ?? 'Non notée' }}</p>
                                <p class="result-album">Album : {{ $result->album_titre ?? 'Aucun album' }}</p>
                                <p class="result-album">URL :</p>
                            </div>
                            <div class="result-image-container">
                                <img src="{{ $result->photo_url }}" alt="Image de {{ $result->photo_titre }}" class="result-photo-image">
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            @else
                <p class="no-results-message">Aucun résultat trouvé.</p>
            @endif
        </div>




</section>

@endsection