@extends('layout')

@section('contenu')

<head>
<link rel="stylesheet" type="text/css" href="{{asset('/css/ajouterphoto.css')}}"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet" >
</head>

<body>
    <section>

        <h1 class="titre-1">AJOUTER UNE</h1>
        <h1 class="titre-2">NOUVELLE PHOTO</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <form action="{{ route('enregistrerphoto') }}" method="POST" enctype="multipart/form-data" id="form">
    @csrf
    <div class="types-photo">
        <input type="text" name="titre" id="select-album" required placeholder="Titre de votre photo...">
        <input type="url" name="url" id="url-input" placeholder="URL de votre photo..." style="display: none;">
    </div>
    <label class="titre-label-photo">Option pour la photo ?</label>
    <div id="url-local">
        <div class="centre">
            <input type="radio" id="url_option" name="photo_option" value="url" checked>
            <label for="url_option">URL</label>
        </div>
        <div class="centre">
            <input type="radio" id="local_option" name="photo_option" value="local">
            <label for="local_option">Fichier local</label>
        </div>
    </div>

    <label class="custom-file-upload label" id="deux-rectangle" style="display: none;">
        <p>Choisissez un fichier</p>
        <i class='bx bx-file'></i>
        <input type="file" name="local_file" accept="image/*" class="hidden">
    </label>




            <div class="note-tags">
                    <input type="number" name="note" min="0" max="5" placeholder="Note...">
                    <input type="text" name="tags" placeholder="Tags...">      
            </div>



            
            <div class="types-album">
                <label for="album_id" class="text">Quels types d’album ?</label>

                <select name="album_id" required id="select-album">

                    <option value="">Choisissez votre album</option>
                    
                    @foreach($albums as $album)
                        <option value="{{ $album->id }}" id="taille-option">{{ $album->titre }}</option>
                    @endforeach

                </select>
            </div>
            
            <hr>

            <div class="div-envoyer">
                <button type="submit" class="bouton-envoyer">AJOUTER</button>
            </div>

        </form>
        <script>
document.addEventListener('DOMContentLoaded', function() {
    const urlOption = document.getElementById('url_option');
    const localOption = document.getElementById('local_option');
    const urlInput = document.getElementById('url-input');
    const fileInput = document.getElementById('deux-rectangle');

    function toggleInputs() {
        if (urlOption.checked) {
            urlInput.style.display = 'block';
            urlInput.required = true;
            fileInput.style.display = 'none';
            fileInput.querySelector('input').required = false;
        } else {
            urlInput.style.display = 'none';
            urlInput.required = false;
            fileInput.style.display = 'block';
            fileInput.querySelector('input').required = true;
        }
    }

    urlOption.addEventListener('change', toggleInputs);
    localOption.addEventListener('change', toggleInputs);

    // Initial toggle
    toggleInputs();
});
</script>
    </section>
</body>
@endsection