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

Route::get('/album', [MonControleur::class, 'album'])->name('album');

Route::get('/photo', [MonControleur::class, 'photo'])->name('photo');

Route::get('/connexion', [MonControleur::class, 'connexion'])->name('connexion');



