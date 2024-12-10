@extends('layout')

@section('contenu')
<style>
    #zaalbum {
        display: none; 
    }
    #zadate{
        display: none;
    }
</style>
<a id="azalbum" href="?sort=asc&sort_by=titre">Trier A-Z par titre</a>
<a id="zaalbum" href="?sort=desc&sort_by=titre">Trier Z-A par titre</a>


<a id="azdate" href="?sort=asc&sort_by=creation">Trier par date (Ascendant)</a>
<a id="zadate" href="?sort=desc&sort_by=creation">Trier par date (Descendant)</a>
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