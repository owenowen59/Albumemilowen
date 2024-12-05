@extends('layout')

@section('contenu')
<form action="{{ route('enregistreralbum') }}" method="POST">
        @csrf

        
            <label for="titre" class="form-label">Titre de l'album</label>
            <input type="text" class="form-control" id="titre" name="titre" required>
        
<!--
        
            <label for="creation" class="form-label">Date de création</label>
            <input type="date" class="form-control" id="creation" name="creation" required>
        

        
            <label for="user_id" class="form-label">Utilisateur (optionnel)</label>
            <input type="number" class="form-control" id="user_id" name="user_id">
-->

        <button type="submit" class="btn btn-primary">Ajouter l'album</button>
</form>
@endsection