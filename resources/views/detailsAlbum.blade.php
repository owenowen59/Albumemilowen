@extends('layout')

@section('contenu')

<h1>{{ $albums->titre }}</h1>


<h2>Photos</h2>


@if(isset($photos) && count($photos) > 0)
    <ul>
        @foreach ($photos as $photo)
            <li>
            <img src="{{$photo->url}}" alt="image de {{$photo->titre}}" width="200">{{$photo->titre}}
            </li>
            @auth
            <form action="{{ route('photos.supprimer', $photo->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette photo ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
            @endauth
        @endforeach
    </ul>
@else
    <p>Aucune photo trouvée pour cet album.</p>
@endif

@endsection