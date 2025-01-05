@extends('layout')

@section('contenu')

<head>
<link rel="stylesheet" type="text/css" href="{{asset('/css/ajouteralbum.css')}}"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet" >
</head>

<section class="test">

        <h1 class="titre-connexion">AJOUTER UN</h1>
        <h1 class="titre-2">NOUVEL ALBUM</h1>

        <form action="{{ route('enregistreralbum') }}" method="POST" id="form">
                @csrf

                <input type="text" name="titre" required placeholder="Titre de votre album..." id="un-rectangle">
                
<!--
                <label class="custom-file-upload label" id="deux-rectangle" required placeholder="Titre de votre album...">

                        <p>Ajouter une couverture</p>
                        
                        <i class='bx bx-photo-album'></i>
                        
                        <input type="file" name="coverImage" accept="image/*" class="hidden" required>
               
                </label>-->

        <!--
                
                <label for="creation" class="form-label">Date de création</label>
                <input type="date" class="form-control" id="creation" name="creation" required>
                

                
                <label for="user_id" class="form-label">Utilisateur (optionnel)</label>
                <input type="number" class="form-control" id="user_id" name="user_id">
        -->

                <hr>

                <div class="div-envoyer">
                        <button type="submit" class="bouton-envoyer">Envoyer</button>
                </div>
        </form>

</section>
@endsection