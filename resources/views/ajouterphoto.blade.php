@extends('layout')

@section('contenu')
<div class="container">
    <h1>Ajouter une photo</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('enregistrerphoto') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Champs du formulaire -->
        <label for="titre">Titre de la photo</label>
        <input type="text" name="titre" id="titre" required>

        <label>Option pour la photo</label>
        <input type="radio" id="url_option" name="photo_option" value="url" checked>
        <label for="url_option">URL</label>
        <input type="radio" id="local_option" name="photo_option" value="local">
        <label for="local_option">Fichier local</label>

        <div id="url_input">
            <label for="url">URL</label>
            <input type="url" name="url">
        </div>

        <div id="local_input" class="d-none">
            <label for="local_file">Fichier</label>
            <input type="file" name="local_file" accept="image/*">
        </div>

        <label for="note">Note</label>
        <input type="number" name="note" min="0" max="5" required>

        <label for="tags">Tags</label>
        <input type="text" name="tags" placeholder="Exemple : nature, paysage">

        <label for="album_id">Album</label>
        <select name="album_id" required>
            <option value="">Aucun</option>
            @foreach($albums as $album)
                <option value="{{ $album->id }}">{{ $album->titre }}</option>
            @endforeach
        </select>

        <button type="submit">Ajouter</button>
    </form>
</div>
@endsection