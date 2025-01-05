@extends('layout')

@section('contenu')

<!-- <ul>
    @foreach($photos as $photo)
        <li><img src="{{$photo->url}}" alt="image de {{$photo->titre}}" width="200">{{$photo->titre}} {{$photo->tag}}</li>
    @endforeach
</ul> -->

<head>
<link rel="stylesheet" type="text/css" href="{{asset('/css/photo.css')}}"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet" >
</head>

<section class="sec">
    
        <h1 class="titre-connexion">VOS DIFFÉRENTES</h1>
        <h1 class="titre-2">PHOTOS</h1>



        
        <div class="deux-triez-2">
            <a id="buttonazphoto" href="?sort=asc" class="trier-2">Trier A-Z</a>
            <a id="buttonzaphoto" href="?sort=desc" class="trier-2">Trier Z-A</a>
        </div>
    






        <div class="position-du-form">

            <form id="filter-form" class="form-container" method="get" action="{{ route('photo') }}">

                <select id="tags-select" class="tags-dropdown" name="tags[]" multiple>
                    <option value="">-- Sélectionnez des tags --</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->nom }}" {{ in_array($tag->nom, $selectedTags ?? []) ? 'selected' : '' }}>
                            {{ $tag->nom }}
                        </option>
                    @endforeach
                </select>

                <button id="filter-button" class="btn-submit" type="submit">Filtrer</button>

            </form>

        </div>





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




        <ul id="photo-list" class="photo-grid">
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
        </div>

        

        @endsection


        <!--
                <div id="module" class="module">
                    <div class="module-content">
                        <span class="close" onclick="closeModule()">&times;</span>
                        <img id="module-img" src="" alt="image agrandie">
                        <p id="module-text"></p>
                    </div>
                </div>-->



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












            