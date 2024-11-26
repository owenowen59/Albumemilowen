@extends('layout')

@section('contenu')
<a href="?ordre=annee">Tri par année</a>
<a href="?ordre=titre">Tri par titre</a>
Les albums: 
<ul>
        @foreach($albums as $albums)
            <h2><a href="{{route('detailsAlbum', ['id' => $albums->id])}}"> {{$albums->titre}}  {{$albums->creation}}</a></h2>
            
            <form action="{{ route('albums.supprimer', $albums->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet album ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        @endforeach
</ul>
@endsection