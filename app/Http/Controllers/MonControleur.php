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
        $search = $request->input('layout');

        

        $search = '%' . $search . '%';

        
        $results = DB::select(
            'SELECT $search = photos.titre AS photo_titre, albums.titre AS album_titre FROM photos
            LEFT JOIN albums ON photos.album_id = albums.id
            WHERE LOWER(photos.titre) LIKE LOWER(?)',
            [$search]
        );

        return view('search', ['results' => $results]);
    }



    function connexion(){
        return view('connexion');
    }
    function photos(){
        $photos = Photo::all();

        
        return view('photo', [
            "photos" => $photos
        ]);
    }

    public function albums(){
        $albums = Album::all();
        return view("albums", ["albums" => $albums]);
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
        $request->validate([
            'titre' => 'required|string|max:255',
            'photo_option' => 'required|in:url,local',
            'url' => 'nullable|required_if:photo_option,url|url',
            'local_file' => 'nullable|required_if:photo_option,local|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            'note' => 'required|numeric|min:0|max:10',
            'tags' => 'nullable|string',
            'album_id' => 'required|exists:albums,id',
        ]);

        $path = null;

        
        if ($request->photo_option === 'url') {
            $path = $request->url;
        }

        if ($request->photo_option === 'local') {
            $file = $request->file('local_file');
            $path = $file->store('photos', 'public'); 
            $path = asset('storage/' . $path); 
        }

        $photo = new Photo();
        $photo->titre = $request->titre;
        $photo->url = $path; 
        $photo->note = $request->note;
        $photo->album_id = $request->album_id;
        $photo->save();


        if (!empty($request->tags)) {
            $tagNames = explode(',', $request->tags); // Diviser les tags par virgule
            $tagIds = [];
    
            foreach ($tagNames as $tagName) {
                $tagName = trim($tagName); // Supprimer les espaces autour
                if (!empty($tagName)) {
                    // Vérifiez si le tag existe déjà
                    $tag = Tag::firstOrCreate(['nom' => $tagName]);
                    $tagIds[] = $tag->id;
                }
            }
    
            // Associez les tags à la photo
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