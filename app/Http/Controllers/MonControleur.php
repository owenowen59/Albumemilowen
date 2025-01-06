<?php

namespace App\Http\Controllers;


use App\Models\Album;
use App\Models\Photo;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;


use Illuminate\Support\Facades\DB;


class MonControleur extends Controller
{
    use AuthorizesRequests, ValidatesRequests;





    function index(){
        return view('index');
    }


    public function search(Request $request)
    {
        $search = $request->input('search');

        

        $searchTerm = '%' . strtolower($search) . '%';

        
        $results = DB::select(
            'SELECT 
                photos.titre AS photo_titre, 
                photos.note AS photo_note, 
                photos.url AS photo_url, 
                albums.titre AS album_titre
             FROM photos
             LEFT JOIN albums ON photos.album_id = albums.id
             WHERE LOWER(photos.titre) LIKE ?',
            [$searchTerm]
        );

        

        return view('search', ['results' => $results,]);
    }



    function connexion(){
        return view('connexion');
    }

/*
    function tagsphotos(Request $request)
    {
        $query = Photo::query();
        $tags = Tag::all();

        // Si un ou plusieurs tags sont sélectionnés, filtrez les photos
        if ($request->has('tags') && !empty($request->tags)) {
            $selectedTags = $request->tags;
            $query->whereHas('tags', function ($q) use ($selectedTags) {
                $q->whereIn('nom', $selectedTags);
            });
        }

        // Appliquer un tri si spécifié
        if ($request->has('sort')) {
            $query->orderBy('titre', $request->sort);
        }

        $photos = $query->get();

        return view('photo', [
            'photos' => $photos,
            'tags' => $tags,
            'selectedTags' => $request->tags ?? [],
        ]);
    }*/
    
    function photos(Request $request)
    {
        // Initialiser la requête pour Photo
        $query = Photo::query();

        // Récupérer les tags disponibles pour l'affichage
        $tags = Tag::all();

        // Gestion du tri
        $sortBy = $request->input('sort_by', 'titre'); // Par défaut, tri sur 'titre'
        $sort = $request->input('sort', 'asc'); // Par défaut, ordre ascendant

        // Valider la direction du tri
        if (!in_array($sort, ['asc', 'desc'])) {
            $sort = 'asc';
        }

        // Appliquer le tri à la requête
        $query->orderBy($sortBy, $sort);

        // Filtrer par tags si spécifiés
        if ($request->has('tags') && !empty($request->tags)) {
            $selectedTags = $request->tags;
            $query->whereHas('tags', function ($q) use ($selectedTags) {
                $q->whereIn('nom', $selectedTags);
            });
        }

        // Récupérer les résultats de la requête
        $photos = $query->get();

        // Retourner la vue avec les données nécessaires
        return view('photo', [
            "photos" => $photos,
            "tags" => $tags,
        ]);
    }

    public function albums(){
        $albums = Album::all();
        

        return view("albums", ["albums" => $albums]);

    }

    public function trialbum(Request $request)
    {
        $sortBy = $request->input('sort_by', 'titre'); 
        $sort = $request->input('sort', 'asc'); 

        if (!in_array($sort, ['asc', 'desc'])) {
            $sort = 'asc'; 
        }

        $albums = Album::orderBy($sortBy, $sort)->get();

        return view('albums', compact('albums'));
    }

    public function triphoto(Request $request)
    {
     
        return $photos;
        return view('photo', compact('photos'));
    }

    public function detailsAlbum($album_id)
{
    // Récupérer l'album avec ses photos
    $album = Album::with('photos')->findOrFail($album_id);

    // Récupérer les photos associées
    $photos = $album->photos;

    // Retourner la vue avec les données
    return view('detailsAlbum', ['album' => $album, 'photos' => $photos]);
        /*GROUP_CONCAT(tags.nom SEPARATOR ", ") AS tags*/
        /*LEFT JOIN possede_tag ON photos.id = possede_tag.photo_id
        LEFT JOIN tags ON possede_tag.tag_id = tags.id*/
        /*
        $albums = DB::select('SELECT * FROM albums WHERE id = ?', [$album_id]);
        if (empty($albums)) {
            abort(404, "Album non trouvé");
        }

        $photos = DB::select('SELECT photos.*, 
        GROUP_CONCAT(tags.nom SEPARATOR ", ") AS tags
        FROM photos
        LEFT JOIN possede_tag ON photos.id = possede_tag.photo_id
        LEFT JOIN tags ON possede_tag.tag_id = tags.id
        WHERE photos.album_id = ?
        GROUP BY photos.id', [$album_id]);

        $photos = $photos ?? [];

        return view('detailsAlbum', [
            'albums' => $albums[0],
            'photos' => $photos,
        ]);*/
    }


    public function ajouterphoto()
    {
    $albums = Album::all();
    return view('ajouterphoto', compact('albums'));
    }

public function enregistrerphoto(Request $request)
{
    $messages = [
        'url.required_if' => 'URL requise lorsque vous choisissez option URL.',
        'local_file.required_if' => 'Fichier local requis lorsque vous choisissez option fichier local.',
    ];

    $request->validate([
        'titre' => 'required|string|max:255',
        'photo_option' => 'required|in:url,local',
        'url' => 'required_if:photo_option,url|url',
        'local_file' => 'required_if:photo_option,local|image|mimes:jpeg,png,jpg,gif|max:2048',
        'note' => 'required|numeric|min:0|max:5',
        'tags' => 'nullable|string',
        'album_id' => 'required|exists:albums,id',
    ], $messages);
    
    $photo = new Photo();
    $photo->titre = $request->titre;
    $photo->note = $request->note;
    $photo->album_id = $request->album_id;

    if ($request->photo_option === 'url') {
        $photo->url = $request->url;
    } 
    if ($request->photo_option === 'local') {
        $path = $request->file('local_file')->store('public/photos');
        $photo->url = Storage::url($path);
    }
    
    $photo->save();

    // Gestion des tags
    if (!empty($request->tags)) {
        $tagNames = array_filter(array_map('trim', explode(',', $request->tags)));
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['nom' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $photo->tags()->sync($tagIds);
    }

    return redirect()->route('ajouterphoto')->with('success', 'Photo ajoutée avec succès.');
}


    public function ajouteralbum()
    {
        $albums = Album::all();
        return view('ajouteralbum', compact('albums')); 
    }

    public function enregistreralbum(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',/*
            'creation' => 'required|date', 
            'user_id' => 'nullable|exists:users,id', */
        ]);

        $album = new Album();
        $album->titre = $request->titre;
        $album->creation = now();
        $album->user_id = auth()->id(); 
        $album->save();

        return redirect()->route('ajouteralbum')->with('success', 'Album ajouté avec succès.');
    }



    public function supprimerPhoto($id)
    {
        $photo = Photo::find($id);

        if (!$photo) {
            return redirect()->back()->with('error', 'Photo introuvable.');
        }

        if ($photo->url && strpos($photo->url, asset('storage/')) === 0) {
            $filePath = str_replace(asset('storage/'), '', $photo->url);
            Storage::disk('public')->delete($filePath);
        }

        $photo->delete();

        return redirect()->back()->with('success', 'Photo supprimée avec succès.');
    }


    public function supprimerAlbum($id)
    {
        $album = Album::find($id);

        if (!$album) {
            return redirect()->back()->with('error', 'Album introuvable.');
        }

        // Laravel supprimera automatiquement les photos liées grâce à la cascade
        $album->delete();

        return redirect()->back()->with('success', 'Album supprimé avec succès.');
    }
}