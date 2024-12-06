<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/layout.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/album.css')}}"/>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="{{asset('/js/layout.js')}}"></script>
</head>
<body>
<header>
    

    <nav id="menu">
        <a href="{{route('index')}}">
            <img src="{{asset('/img/logo.webp')}}" alt="logo" class="logo">
        </a>
    </nav> 

    <form action="{{ route('search') }}" method="POST">
        @csrf
        <input type="text" name="search" placeholder="Rechercher..." class="Rectangle-Rechercher">
        <button type="submit" class="Rectangle-Rechercher"><i class='bx bx-search' id="loupe"></i></button>
    </form>
    
    <nav>
        <ul class="menu-items">
            <li><a href="{{route('index')}}" class="mot-nav">Accueil</a></li>
            <li><a href="{{route('album')}}" class="mot-nav">Album</a></li>
            <li><a href="{{route('photo')}}" class="mot-nav">Photo</a></li>
            @guest
            <li><a href="{{route('login')}}" class="mot-nav">Se connecter</a></li>
            <li><a href="{{route('register')}}" class="mot-nav">Inscription</a></li>
            @endguest
            @auth
        
                <a href="{{route('ajouteralbum')}}" class="mot-nav">Ajouter un Album</a>
                <a href="{{route('ajouterphoto')}}" class="mot-nav">Ajouter une Photo</a>
                <a href="{{route('logout')}}" class="mot-nav"
                onclick="document.getElementById('logout').submit(); return false;">Se déconnecter</a>
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
        <div>
            <p>Salut tout le monde</p>
        </div>
    </footer>

</body>
</html>