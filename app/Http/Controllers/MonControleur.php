<?php

namespace App\Http\Controllers;


use App\Models\Album;
use App\Models\Photo;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

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

        // Récupérer les photos associées
        $photos = DB::select('SELECT * FROM photos WHERE album_id = ?', [$album_id]);

        // Si aucune photo, `$photos` sera un tableau vide
        $photos = $photos ?? [];

        return view('detailsAlbum', [
            'albums' => $albums[0],
            'photos' => $photos,
        ]);
    }


    public function ajouterphoto(){
        $albums = Album::all();
        return view('ajouterphoto', compact('albums'));
    }
    public function enregistrerphoto(Request $request)
{
    // Validation des données
    $request->validate([
        'titre' => 'required|string|max:255',
        'photo_option' => 'required|in:url,local',
        'url' => 'nullable|required_if:photo_option,url|url',
        'local_file' => 'nullable|required_if:photo_option,local|image|mimes:jpeg,png,jpg,gif|max:2048',
        'note' => 'required|numeric|min:0|max:10',
        'tags' => 'nullable|string',
        'album_id' => 'required|exists:albums,id',
    ]);

    // Initialisation du chemin d'image
    $path = null;

    // Gestion de l'option "url"
    if ($request->photo_option === 'url') {
        $path = $request->url;
    }

    // Gestion de l'option "local" (fichier téléchargé)
    if ($request->photo_option === 'local') {
        $file = $request->file('local_file');
        $hashname = $file->hashName(); // Génère un nom unique
        $file->storeAs('photos', $hashname, 'public'); // Stocke dans "storage/app/public/photos"
        $path = env("APP_URL") . "/storage/photos/$hashname"; // Génère l'URL complète
    }

    // Création et sauvegarde de la photo
    $photo = new Photo();
    $photo->titre = $request->titre;
    $photo->url = $path; // Ajout du chemin de l'image
    $photo->note = $request->note;
    $photo->album_id = $request->album_id;
    $photo->save();

    // Gestion des tags
    if (!empty($request->tags)) {
        $tagNames = explode(',', $request->tags); // Divise les tags par virgule
        $tagIds = [];

        foreach ($tagNames as $tagName) {
            $tagName = trim($tagName); // Supprime les espaces inutiles
            if (!empty($tagName)) {
                $tag = Tag::firstOrCreate(['nom' => $tagName]); // Crée ou récupère le tag
                $tagIds[] = $tag->id;
            }
        }

        // Synchronise les tags avec la photo
        $photo->tags()->sync($tagIds);
    }
    
    // Redirection avec un message de succès
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
            'titre' => 'required|string|max:255',
            'creation' => 'required|date', 
            'user_id' => 'nullable|exists:users,id', 
        ]);

        $album = new Album();
        $album->titre = $request->titre;
        $album->creation = $request->creation;
        $album->user_id = $request->user_id; 
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