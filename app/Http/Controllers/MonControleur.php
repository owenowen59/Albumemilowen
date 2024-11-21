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
    function photo(){
        return view('photo');
    }

    public function albums(){
        $albums = Album::all();
        return view("albums", ["albums" => $albums]);
    }


    function detailsAlbum($id){
        $albums = Album::findOrFail($id);
    return view("detailsAlbum", ["albums" => $albums]);
    }
}