@extends('layout')

@section('contenu')
<h4>
@auth
    Bonjour {{Auth::user()->name}}
@endauth
</h4>
<p>
La page d'accueil
</p>
@endsection