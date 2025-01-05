@extends("layout")

@section("contenu")

<head>
<link rel="stylesheet" type="text/css" href="{{asset('/css/register.css')}}"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet" >
</head>

<section class="test">

    <h1 class="titre-connexion">S'INSCRIRE</h1>

    <form action="{{route('register')}}" method="post" id="form">
        @csrf
        <input type="text" name="name" required placeholder="Nom" id="deux-rectangle"/>

        <input type="email" name="email" required placeholder="Email" id="deux-rectangle"/>
        
        <input type="password" name="password" required placeholder="Mot de passe" id="deux-rectangle"/>
        
        <input type="password" name="password_confirmation" required placeholder="Vérification du mot de passe" id="deux-rectangle"/>
        
        <div class="div-envoyer">
            <input type="submit" id="envoyer-rectangle"/>
        </div>

    </form>

    <p class="texte-un-compte">Vous avez déjà un compte ?</p>
    <a href="{{route('login')}}" class="connectez-vous">Connectez-vous</a>

</section>

@endsection