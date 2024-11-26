@extends('layout')

@section('contenu')
La page d'ajout photo
<form action="{{ route('enregistrerphoto') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- titre -->
        <label for="titre" class="form-label">Titre de la photo</label>
        <input type="text" name="titre" id="titre" class="form-control" required>
        

        <!-- photo -->
        <label for="photo_option" class="form-label">Option pour la photo</label>
            
        <input type="radio" id="url_option" name="photo_option" value="url" checked>
        <label for="url_option">Ajouter via URL</label>
            
        <input type="radio" id="local_option" name="photo_option" value="local">
        <label for="local_option">Ajouter via fichier local</label>
        
        <label for="url" class="form-label">URL de l'image</label>
        <input type="url" name="url" id="url" class="form-control">
        

        <label for="local_file" class="form-label">Fichier local</label>
        <input type="file" name="local_file" id="local_file" class="form-control" accept="image/*">
        

        <!--Note-->
        <label for="note" class="form-label">Note</label>
        <input type="number" name="note" id="note" class="form-control" min="0" max="10">
        
        <!--Tags-->
        <label for="tags" class="form-label">Tags (séparés par des virgules)</label>
        <input type="text" name="tags" id="tags" class="form-control" placeholder="Exemple : nature, paysage, vacances">

        <!-- sélection de l'emplacement de la photo dans un album -->
        <label for="album_id" class="form-label">Album</label>
        <select name="album_id" id="album_id" class="form-control">
            <option value="">Aucun</option>
            @foreach($albums as $album)
                <option value="{{ $album->id }}">{{ $album->titre }}</option>
            @endforeach
        </select>
        

        <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const urlOption = document.getElementById('url_option');
        const localOption = document.getElementById('local_option');
        const urlInput = document.getElementById('url_input');
        const localInput = document.getElementById('local_input');

        urlOption.addEventListener('change', function () {
            if (urlOption.checked) {
                urlInput.classList.remove('d-none');
                localInput.classList.add('d-none');
               
            }
        });

        localOption.addEventListener('change', function () {
            if (localOption.checked) {
                urlInput.classList.add('d-none');
                localInput.classList.remove('d-none');
            }
        });
    });
</script>
@endsection