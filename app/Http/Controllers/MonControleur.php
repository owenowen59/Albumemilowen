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


    function ajouterphoto(){
        return view('ajouterphoto');
    }


    function ajouteralbum(){
        return view('ajouteralbum');
    }


}