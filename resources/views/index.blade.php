@extends('layout')

@section('contenu')
<head>
<link rel="stylesheet" type="text/css" href="{{asset('/css/accueil.css')}}"/>
</head>
<h4>
@auth
    Bonjour {{Auth::user()->name}}
@endauth
<section class="background-blue">
    <div>
        <img src=/img.jpg class="cercle-1"></img>
        <img src=/img.jpg class="cercle-2"></img>
    </div>

    <div>
        <h1>BIENVENUE SUR</h1>
        <h1>FLASHBACK</h1>
        <p>Partagez vos meilleurs moments !</p>
    </div>

    <div>
        <img src=/img.jpg class="cercle-3"></img>
        <img src=/img.jpg class="cercle-4"></img>
    </div>
</section>
@endsection