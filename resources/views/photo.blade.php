@extends('layout')

@section('contenu')

<!-- <ul>
    @foreach($photos as $photo)
        <li><img src="{{$photo->url}}" alt="image de {{$photo->titre}}" width="200">{{$photo->titre}} {{$photo->tag}}</li>
    @endforeach
</ul> -->
<style>
  .hidden {
    display: none; 
  }
</style>
<a id="buttonazphoto" href="?sort=asc">Trier A-Z</a>
<a id="buttonzaphoto" href="?sort=desc" style=".hidden">Trier Z-A</a>
<script>
    const buttonazphoto = document.getElementById('buttonazphoto');
    const buttonzaphoto = document.getElementById('buttonzaphoto');

buttonazphoto.addEventListener('click' => {
        buttonazphoto.classList.add('hidden');
        buttonzaphoto.classList.remove('hidden');
});

buttonzaphoto.addEventListener('click' => {
    buttonzaphoto.classList.add('hidden');
    buttonazphoto.classList.remove('hidden');
    });

</script>
<ul>
    
@foreach($photos as $photo)


    <li><img onclick="openModule('{{ $photo->Url }}', '{{ $photo->titre }}')" src="{{$photo->url}}" alt="image de {{$photo->titre}}" width="200">{{$photo->titre}} {{$photo->tag}}
    </div>
    <p>Note : {{ $photo->note ?? 'Non notée' }}</p>
    <h2>Tags :</h2>
    @if($photo->tags->count() > 0)
        <ul>
            @foreach ($photo->tags as $tag)
                <li>{{ $tag->nom }}</li>
            @endforeach
        </ul>
    @else
        <p>Pas de tags associés à cette photo.</p>
    @endif
    </li>
        @auth
        <form action="{{ route('photos.supprimer', $photo) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette photo ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
        @endauth
    @endforeach
    </ul>


<!--
<div id="module" class="module">
    <div class="module-content">
        <span class="close" onclick="closeModule()">&times;</span>
        <img id="module-img" src="" alt="image agrandie">
        <p id="module-text"></p>
    </div>
</div>-->
@endsection