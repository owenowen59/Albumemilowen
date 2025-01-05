@extends('layout')

@section('contenu')

<head>
<link rel="stylesheet" type="text/css" href="{{asset('/css/album.css')}}"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet" >
</head>

<section>

        <h1 class="titre-connexion">VOTRE ALBUM</h1>
        <h1 class="titre-2">PHOTO</h1>

        <div class="deux-triez">

                <a id="azalbum" href="?sort=asc&sort_by=titre" class="trier">Trier A-Z par titre</a>
                <a id="zaalbum" href="?sort=desc&sort_by=titre" class="trier">Trier Z-A par titre</a>
            
                <a id="azdate" href="?sort=asc&sort_by=creation" class="trier">Trier par date (Ascendant)</a>
                <a id="zadate" href="?sort=desc&sort_by=creation" class="trier">Trier par date (Descendant)</a>

        </div>
        
        <div class="grid-album">
                <ul class="album-ul">
                         @foreach($albums as $albums)  
                                
                        <div class="div-album">

                                <img src="https://www.journaldutextile.com/wp-content/uploads/2024/05/Les-activites-preferees-des-Francais-en-vacances-1024x683.jpg">
                                <h2><a href="{{route('detailsAlbum', ['id' => $albums->id])}}" class="titre-album"> {{$albums->titre}} </a></h2>
                                <h2 class="titre-album"><a> {{$albums->creation}}</a></h2>

                                @auth
                                <form action="{{ route('albums.supprimer', $albums->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet album ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-supp">Supprimer</button>
                                </form>
                        </div>
                        @endauth
                        @endforeach
                </ul>
        </div>

</section>
@endsection