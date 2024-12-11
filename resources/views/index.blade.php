@extends('layout')

@section('contenu')
<head>
<link rel="stylesheet" type="text/css" href="{{asset('/css/accueil.css')}}"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet" >
</head>
@auth
    Bonjour {{Auth::user()->name}}
@endauth
<section class="background-blue test">



    <div  class="texte-centre">
        <p class="white-text-h1">BIENVENUE SUR</p>
        <p class="orange-text-h1">FLASHBACK</p>
        <p class="white-text-p">Partagez vos meilleurs moments !</p>
    </div>

</section>
@endsection