<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/layout.css')}}"/>
    <script src="{{asset('/js/layout.js')}}"></script>
</head>
<body>
<header>
    <nav id="menu">
        <a href="{{route('index')}}">
            <img src="{{asset('/img/logo.webp')}}" alt="logo" class="logo">
        </a>

        <button class="burger" aria-label="Menu">
                ☰
        </button>
        
        <ul class="menu-items">
            <li><a href="{{route('index')}}" class="mot-nav">Home Page</a></li>
            <li><a href="{{route('album')}}" class="mot-nav">Album</a></li>
            <li><a href="{{route('photo')}}" class="mot-nav">Photo</a></li>
            @auth
        
                <a href="{{route('ajouteralbum')}}" class="mot-nav">Ajouter un Album</a>
                <a href="{{route('ajouterphoto')}}" class="mot-nav">Ajouter une Photo</a>
                <a href="{{route('logout')}}" class="mot-nav"
                onclick="document.getElementById('logout').submit(); return false;">Se déconnecter</a>
                <form id="logout" action="{{route('logout')}}" method="post">
                @csrf
                </form>
                @else
                <a href="{{route('login')}}" class="mot-nav">Se connecter</a>
                <a href="{{route('register')}}" class="mot-nav">Inscription</a>
            @endauth
        </ul>
    </nav>
</header>

   

    <main>
        @auth
            Bonjour {{Auth::user()->name}}
        @endauth
        @yield('contenu')
    </main>

    <footer>
        <div>
            <p>Salut tout le monde</p>
        </div>
    </footer>

</body>
</html>