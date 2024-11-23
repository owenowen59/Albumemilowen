<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonControleur;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MonControleur::class, 'index'])->name('index');

Route::get('/album', [MonControleur::class, 'albums'])->name('album');
Route::get('/album/{id}', [MonControleur::class, 'detailsAlbum'])->name('detailsAlbum');
Route::get('/photos', [MonControleur::class, 'photos'])->name('photo');

Route::middleware(['auth'])->group(function () {
    Route::get('/album/Ajouterphotos', [MonControleur::class, 'ajouterphoto'])->name('ajouterphoto')/*-where(['id'=>'[0-9]+'])*/;
    Route::get('/album/Ajouteralbums', [MonControleur::class, 'ajouteralbum'])->name('ajouteralbum')/*-where(['id'=>'[0-9]+'])*/;
});


Route::get('/connexion', [MonControleur::class, 'connexion'])->name('connexion');



