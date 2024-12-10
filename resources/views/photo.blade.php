@extends('layout')

@section('contenu')

<!-- <ul>
    @foreach($photos as $photo)
        <li><img src="{{$photo->url}}" alt="image de {{$photo->titre}}" width="200">{{$photo->titre}} {{$photo->tag}}</li>
    @endforeach
</ul> -->
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
<a id="buttonazphoto" href="?sort=asc">Trier A-Z</a>
<a id="buttonzaphoto" href="?sort=desc" style=".hidden">Trier Z-A</a>
<script>
    /*
    const buttonazphoto = document.getElementById('buttonazphoto');
    const buttonzaphoto = document.getElementById('buttonzaphoto');

    buttonazphoto.addEventListener('click' => {
        buttonazphoto.classList.add('hidden');
        buttonzaphoto.classList.remove('hidden');
    });

    buttonzaphoto.addEventListener('click' => {
        buttonzaphoto.classList.add('hidden');
        buttonazphoto.classList.remove('hidden');
    });*/
</script>
<ul>
    
@foreach($photos as $photo)
    <li>
        <img src="{{$photo->url}}" 
        alt="image de {{$photo->titre}}" 
        width="200" 
        class="image-modal" 
             data-url="{{ $photo->url }}" 
             data-titre="{{ $photo->titre }}" 
             data-note="{{ $photo->note }}" 
             data-tags="{{ $photo->tags->pluck('nom')->join(', ') }}">
        {{$photo->titre}} 
             
    
    <!-- <p>Note : {{ $photo->note ?? 'Non notée' }}</p>
    <h2>Tags :</h2>
    @if($photo->tags->count() > 0)
        <ul>
            @foreach ($photo->tags as $tag)
                <li>{{ $tag->nom }}</li>
            @endforeach
        </ul>
    @else
        <p>Pas de tags associés à cette photo.</p>
    @endif -->
    </li>
    @auth
    <form action="{{ route('photos.supprimer', $photo) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette photo ?');">
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


<!--
<div id="module" class="module">
    <div class="module-content">
        <span class="close" onclick="closeModule()">&times;</span>
        <img id="module-img" src="" alt="image agrandie">
        <p id="module-text"></p>
    </div>
</div>-->
@endsection