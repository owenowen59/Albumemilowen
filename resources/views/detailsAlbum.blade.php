@extends('layout')

@section('contenu')

<h1>{{ $albums->titre }}</h1>


<h2>Photos</h2>
<style>
    .hidden {
    display: none; 
    }
    #modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    #modal span {
            display: block;
            margin-bottom: 10px;
    }
</style>
  
@if(isset($photos) && count($photos) > 0)
    <ul>
        @foreach ($photos as $photo)
            <li>
            <img src="{{$photo->url}}" 
                alt="image de {{$photo->titre}}" 
                width="200"
                class="image-modal" 
                    data-url="{{ $photo->url }}" 
                    data-titre="{{ $photo->titre }}" 
                    data-note="{{ $photo->note }}" 
                    data-tags="{{ $photo->tags ?? 'Aucun tag' }}">
                {{$photo->titre}}
            </li>
            @auth
            <form action="{{ route('photos.supprimer', $photo->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette photo ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
            @endauth
            <div id="modal">
                <img id="modal-image" alt="Image agrandie" style="max-width: 100%; height: auto;">
                <span id="nom"></span>
                <span id="note"></span>
                <span id="tag"></span>
                <button id="closeModal">Close</button>
            </div>
        @endforeach
    </ul>
@else
    <p>Aucune photo trouvée pour cet album.</p>
@endif

@endsection