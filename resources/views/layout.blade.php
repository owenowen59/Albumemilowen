<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/style.css"/>
</head>
<body>
    <nav id=menu>
        <a href="{{ route('index') }}"> Home Page </a>
        <a href="{{route('album')}}"> Album </a>
        <a href="{{route('photo')}}"> Photo </a>
        <a href="{{route('connexion')}}"> Connexion </a>

    </nav>

    <main>
        @yield('contenu')
    </main>
</body>
</html>