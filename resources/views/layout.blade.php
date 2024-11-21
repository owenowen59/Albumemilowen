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
        <nav id=menu>
            <a href="{{route('index') }}"> Home Page </a>
            <a href="{{route('album')}}"> Album </a>
            <a href="{{route('photo')}}"> Photo </a>
            <a href="{{route('connexion')}}"> Connexion </a>
        </nav>
    </header>
   

    <main>
        @yield('contenu')
    </main>

    <footer></footer>

</body>
</html>