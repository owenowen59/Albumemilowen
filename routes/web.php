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
    Route::get('/ajouterphoto', [MonControleur::class, 'ajouterphoto'])->name('ajouterphoto');
    Route::get('/ajouteralbum', [MonControleur::class, 'ajouteralbum'])->name('ajouteralbum');
});


Route::get('/connexion', [MonControleur::class, 'connexion'])->name('connexion');



