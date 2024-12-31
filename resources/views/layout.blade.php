<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flashback</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/layout.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/album.css')}}"/>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="{{asset('/js/layout.js')}}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet" >
    <link></link>
</head>
<body>
<header>
    
    
    <a href="{{route('index')}}">
        <img src="{{asset('/img/logo.webp')}}" alt="logo" class="logo">
    </a>
    

    <form action="{{ route('search') }}" method="POST" class="barre-de-recherche">
        @csrf
        <input type="text" name="search" placeholder="Rechercher..." class="Rectangle-Rechercher">
        
        <button type="submit" class="Rectangle-Rechercher"><i class='bx bx-search' id="loupe"></i></button>
    </form>
    
    <nav>
        <ul class="menu-items">
            <li><a href="{{route('index')}}" class="mot-nav"><h4>ACCUEIL</h4></a></li>
            <li><a href="{{route('album')}}" class="mot-nav"><h4>ALBUM</h4></a></li>
            <li><a href="{{route('photo')}}" class="mot-nav"><h4>PHOTO</h4></a></li>
            @guest
            <li><a href="{{route('login')}}" class="mot-nav"><h4>SE CONNECTER</h4></a></li>
            <li><a href="{{route('register')}}" class="mot-nav"><h4>INSCRIPTION</h4></a></li>
            @endguest
            @auth
        
            <li><a href="{{route('ajouteralbum')}}" class="mot-nav"><h4>AJOUTER UN ALBUM</h4></a></li>
            <li><a href="{{route('ajouterphoto')}}" class="mot-nav"><h4>AJOUTER UNE PHOTO</h4></a></li>
            <li><a href="{{route('logout')}}" class="mot-nav" onclick="document.getElementById('logout').submit(); return false;"><h4>SE DÉCONNECTER</h4></a></li>
                <form id="logout" action="{{route('logout')}}" method="post">
                @csrf
                </form>
                @else
            @endauth
        </ul>
    </nav>  

    <button class="burger" aria-label="Menu">☰</button>
    
</header>

   

    <main>
        
        @yield('contenu')
    </main>

    <footer>
        <div class="lien-footer">
            <a href="#">Mentions légales</a>
            <a href="#">©COPYRIGHT MMI</a>
            <a href="#">Conditions d'utilisation</a>
        </div>
    </footer>

</body>
</html>