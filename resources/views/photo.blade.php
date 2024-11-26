@extends('layout')

@section('contenu')
<!-- <ul>
    @foreach($photos as $photo)
        <li><img src="{{$photo->url}}" alt="image de {{$photo->titre}}" width="200">{{$photo->titre}} {{$photo->tag}}</li>
    @endforeach
</ul> -->
<ul>
@foreach($photos as $photo)
<li><img src="{{$photo->url}}" alt="image de {{$photo->titre}}" width="200">{{$photo->titre}} {{$photo->tag}}
<p>Note : {{ $photo->note ?? 'Non notée' }}</p>
<h2>Tags :</h2>
@if($photo->tags->count() > 0)
    <ul>
        @foreach ($photo->tags as $tag)
            <li>{{ $tag->nom }}</li>
        @endforeach
    </ul>
@else
    <p>Pas de tags associés à cette photo.</p>
@endif
</li>
    <form action="{{ route('photos.supprimer', $photo->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette photo ?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
@endforeach
</ul>
@endsection