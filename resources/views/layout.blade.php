<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/css/layout.css')}}"/>
</head>
<body>
<header>
    <nav id="menu">
        <a href="{{route('index')}}">
            <img src="{{asset('/img/logo.webp')}}" alt="logo" class="logo">
        </a>

        
        <div id="burger" class="burger">
            <span></span>
            <span></span>
            <span></span>
        </div>

        
        <ul class="menu-items">
            <li><a href="{{route('index')}}" class="mot-nav">Home Page</a></li>
            <li><a href="{{route('album')}}" class="mot-nav">Album</a></li>
            <li><a href="{{route('photo')}}" class="mot-nav">Photo</a></li>
            <li><a href="{{route('connexion')}}" class="mot-nav">Connexion</a></li>
        </ul>
    </nav>
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