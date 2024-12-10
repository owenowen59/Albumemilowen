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
    function photos(){
        $photos = Photo::all();

        
        return view('photo', ["photos" => $photos]);
    }

    public function albums(){
        $albums = Album::all();
        

        return view("albums", ["albums" => $albums]);

    }

    public function trialbum(Request $request)
    {
        $sort = $request->query('sort', 'asc'); // Par défaut : 'asc'
        $albums = Album::orderBy('titre', $sort)->get();
    
        return view('albums', compact('albums'));
    }

    public function triphoto(Request $request)
    {
        $sort = $request->query('sort', 'asc'); // Par défaut : 'asc'
        $photos = Photo::orderBy('titre', $sort)->get();
    
        return view('photo', compact('photos'));
    }

    public function detailsAlbum($album_id)
    {/*
        $album = Album::with('photos')->findOrFail($id);
    
        return view('detailsAlbum', ['album' => $album]);*/
            // Récupérer l'album
        $albums = DB::select('SELECT * FROM albums WHERE id = ?', [$album_id]);
        if (empty($albums)) {
            abort(404, "Album non trouvé");
        }

        // On récupère les photos associés à l'album
        $photos = DB::select('SELECT photos.*, 
        GROUP_CONCAT(tags.nom SEPARATOR ", ") AS tags
        FROM photos
        LEFT JOIN possede_tag ON photos.id = possede_tag.photo_id
        LEFT JOIN tags ON possede_tag.tag_id = tags.id
        WHERE photos.album_id = ?
        GROUP BY photos.id', [$album_id]);

        // Le tableau `photos` sera un tableau vide si l'album sélectionné ne contient pas de photos
        $photos = $photos ?? [];

        return view('detailsAlbum', [
            'albums' => $albums[0],
            'photos' => $photos,
        ]);
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
        'local_file.required_if' => 'fichier local requis lorsque vous choisissez option fichier local.',
    ];

    $request->validate([
        'titre' => 'required|string|max:255',
        'photo_option' => 'required|in:url,local',
        'url' => 'nullable|required_if:photo_option,url|url',
        'local_file' => 'nullable|required_if:photo_option,local|image|mimes:jpeg,png,jpg,gif|max:2048',
        'note' => 'required|numeric|min:0|max:10',
        'tags' => 'nullable|string',
        'album_id' => 'required|exists:albums,id',
    ], $messages);

    $photo = new Photo();
    $photo->titre = $request->titre;
    $photo->note = $request->note;
    $photo->album_id = $request->album_id;

    // Gestion des images
    if ($request->photo_option === 'url') {
        /* $path = $request->url->store('public/photos');
        $photo->url = Storage::url($path); */


         
        
        $imageName = $request->url;
        $path = $imageName;
        $photo->url = $path;
    } else {
        $path = $request->file('local_file')->store('public/photos');
        $photo->url = Storage::url($path);
    }

    $photo->save();

    // Gestion des tags
    if (!empty($request->tags)) {
        $tagNames = array_filter(array_map('trim', explode(',', $request->tags))); // Supprime espaces vides
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