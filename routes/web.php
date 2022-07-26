<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HeureSupplementaireController;


Route::get('/', function () {
    return view('index_accueil');
})->name('accueil_perso');

Route::get('sign-in', function () {
    return view('auth.connexion');
})->name('sign-in');

Route::get('create-compte', function () {
    return view('create_compte.create_compte');
})->name('create-compte');

Route::get('/info_legale', function () {
    return view('/info_legale');
});
Route::get('contact', function () {
    return view('contact');
});
Route::get('contacts', function () {
    return view('contacts');
});
Route::get('/politique_confidentialite', function () {
    return view('/politique_confidentialite');
})->name('politique_confidentialite');

Route::get('/politique_confidentialites', function () {
    return view('/politique_confidentialites');
});
Route::get('/tarifs', function () {
    return view('/tarif');
});
Route::get('condition_generale_de_vente', [ConditionController::class,'index'])->name('condition_generale_de_vente');


// accueil affiche direct le clockpicker/pointage
Route::get('home', [HomeController::class,'index'])->name('home');

// validation pointage
Route::get('valider_entrer', [PointageController::class,'entrer'])->name('valider_entrer');
Route::get('valider_sortie', [PointageController::class,'sortie'])->name('valider_sortie');

// modification pointage
Route::get('modifier_entrer', [PointageController::class,'update_entrer'])->name('modifier_entrer');
Route::get('modifier_sortie', [PointageController::class,'update_sortie'])->name('modifier_sortie');

// affichage feuille de temps
Route::get('/feuille_de_temps', function () {
    return view('pointage.feuille_de_temps');
});

// insertion feuille de temps
Route::post('valider_feuille_de_temps', [PointageController::class,'valider_feuille_de_temps'])->name('valider_feuille_de_temps');

// liste heure supplementaire
Route::get('liste_heure_supplementaire', [HeureSupplementaireController::class,'liste'])->name('liste_heure_supplementaire');
