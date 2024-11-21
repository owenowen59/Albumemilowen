@extends('layout')

@section('contenu')
Les albums: 
<ul>
        @foreach($albums as $albums)
            <h2><a href="{{route('detailsAlbum', ['id' => $albums->id])}}"> {{$albums->titre}}</a></h2>
        @endforeach
</ul>
@endsection