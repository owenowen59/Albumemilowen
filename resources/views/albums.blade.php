@extends('layout')

@section('contenu')

<a href="?sort=asc">Trier A-Z</a>
<a href="?sort=desc">Trier Z-A</a>
Les albums: 
<ul class="toutalbum">

        @foreach($albums as $albums)
            
            <h2><a href="{{route('detailsAlbum', ['id' => $albums->id])}}"> {{$albums->titre}}  {{$albums->creation}}</a></h2>
            @auth
            <form action="{{ route('albums.supprimer', $albums->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet album ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
            @endauth
        @endforeach

</ul>
@endsection