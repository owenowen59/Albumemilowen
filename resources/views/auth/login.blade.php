@extends("layout")

@section("contenu")

<head>
<link rel="stylesheet" type="text/css" href="{{asset('/css/login.css')}}"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet" >
</head>

<section class="test">

  <h1 class="titre-connexion">CONNEXION</h1>

  <form action="{{route('login')}}" method="post" id="form">
  @csrf

  
      <input type="email" name="email" required placeholder="Email" id="deux-rectangle"></input>
      
      <input type="password" name="password" required placeholder="Mot de passe" id="deux-rectangle"/></input>
      
      <input type="submit" class="rectangle-envoyer">
      

      <div id="div-submit-horizontal">

          <p class="texte-souvenir">Se souvenir de moi ?</p> 
          
          <input type="checkbox" name="remember"/>

      </div>

      <div class="bloc-ou">
          
              <hr>

          <p class="ou">ou</p>
      
              <hr>
  
      </div>

      <div>

        <p class="texte-compte">Vous n'avez pas de compte ?</p>
      
      </div>

      <a href="{{route('register')}}" class="inscrivez-vous">Inscrivez-vous</a>

  </form>

</section>

@endsection