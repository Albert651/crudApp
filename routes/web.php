<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;

Route::get('/produit', [ProduitController::class, 'index']);
Route::post('/produit',[ProduitController::class, 'store']);
Route::get('/produit/{id}', [ProduitController::class, 'show']);
Route::put('/produit/{produit}', [ProduitController::class, 'update']);
Route::delete('/produit/{id}', [ProduitController::class, 'destroy']);

Route::get('/commandeListe', [CommandeController::class, 'index']);
Route::post('/commandeListe', [CommandeController::class, 'create']); // Changé de 'index' à 'create'
Route::get('/commandeListe/{id}', [CommandeController::class, 'show']);
Route::put('/commandeListe/{id}', [CommandeController::class, 'update']);
Route::delete('/commandeListe/{id}', [CommandeController::class, 'destroy']);



Route::get('/', function () {
    return view('welcome');
});

Route::get('/{pageAcceuil}', function(){
    return view('welcome');

})->where('pageAcceuil',".*");

Route::get('/{produit}', function(){
    return view('welcome');

});

Route::get('/{commande}', function(){
    return view('welcome');

});

Route::get('/{commandeListe}', function(){
    return view('welcome');

});