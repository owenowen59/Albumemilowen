@extends('layout')

@section('contenu')
<ul>
    @foreach($photos as $photo)
        <li>{{$photo->titre}}<img src="{{$photo->url}}" alt="image de {{$photo->titre}}"></li>
    @endforeach
</ul>
@endsection