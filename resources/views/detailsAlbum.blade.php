@extends('layout')

@section('contenu')

<head>
<link rel="stylesheet" type="text/css" href="{{asset('/css/detailsalbum.css')}}"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet" >
</head>




<h2 class="titre-details">{{ $album->titre }}, Les différentes photos</h2>
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

<ul id="photo-list" class="photo-grid">
    @foreach($photos as $photo)
        <li class="photo-item">
            <div class="photo-container">
                <img src="{{ $photo->url }}" alt="image de {{ $photo->titre }}" class="image-modal"
                     data-url="{{ $photo->url }}"
                     data-titre="{{ $photo->titre }}"
                     data-note="{{ $photo->note }}"
                     data-tags="{{ $photo->tags && $photo->tags->isNotEmpty() ? $photo->tags->pluck('nom')->join(', ') : 'Aucun tag' }}">
            </div>
            <span class="photo-title">{{ $photo->titre }}</span>

            @auth
            <form action="{{ route('photos.supprimer', $photo) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette photo ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-supprimer">Supprimer</button>
            </form>
            @endauth
        </li>
    @endforeach
</ul>


    <div id="modal" class="modal">
        <div class="modal-content">
            <img id="modal-image" alt="Image agrandie" style="max-width: 100%; height: auto;">
            <span id="nom"></span>
            <span id="note"></span>
            <span id="tag"></span>
            <button id="closeModal" class="btn btn-close">Close</button>
        </div>
    </div>
@else
    <p>Aucune photo trouvée pour cet album.</p>
@endif

@endsection



<!--<ul id="photo-list" class="photo-grid">
            @foreach($photos as $photo)
                <li class="photo-item">
                    <div class="photo-container">
                        <img src="{{$photo->url}}" alt="image de {{$photo->titre}}" class="image-modal" 
                            data-url="{{ $photo->url }}" 
                            data-titre="{{ $photo->titre }}" 
                            data-note="{{ $photo->note }}" 
                            data-tags="{{ $photo->tags->pluck('nom')->join(', ') }}">
                    </div>
                    <span class="photo-title">{{$photo->titre}}</span>

                    @auth
                    <form action="{{ route('photos.supprimer', $photo) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette photo ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-supprimer">Supprimer</button>
                    </form>
                    @endauth
                </li>
            @endforeach
        </ul>

        <div id="modal" class="modal">
            <div class="modal-content">
                <img id="modal-image" alt="Image agrandie" style="max-width: 100%; height: auto;">
                <span id="nom"></span>
                <span id="note"></span>
                <span id="tag"></span>
                <button id="closeModal" class="btn btn-close">Close</button>
            </div>
        </div>-->