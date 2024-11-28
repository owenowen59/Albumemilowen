@extends('layout')

@section('contenu')

@if(!empty($results))
    <div class="search-results">
        @foreach($results as $photo)
            <div class="photo-result">
                <h3>Photo : {{ $photo->photo_titre }}</h3>
                <img src="{{ $photo->url }}" width= 200px;>
                <p>Note : {{ $photo->note }}</p>
                <p>Album : {{ $photo->album_titre }}</p>
            </div>
        @endforeach
    </div>
@else
    <p>Aucune photo trouvée.</p>
@endif

@endsection