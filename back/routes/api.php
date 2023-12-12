<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerrosController;
use App\Http\Controllers\InteraccionController;

Route::group(['prefix' => 'perro'], function () {
    Route::post('newPerro', [PerrosController::class, 'registrarPerro']);
    Route::put('updatePerro/{id}', [PerrosController::class, 'actualizarPerro']);
    Route::get('getAllPerros', [PerrosController::class, 'listarPerros']);
    Route::get('getPerro/{id}', [PerrosController::class, 'listarPerro']);
    Route::get('getPerroAleatorio', [PerrosController::class, 'obtenerPerroAleatorio']);
    Route::get('getPerro', [PerrosController::class, 'obtenerPerroInteresado']);
    Route::get('getPerroAceptado/{idPerroInteresado}', [InteraccionController::class, 'obtenerPerrosAceptados']);
    Route::get('getPerroRechazado/{idPerroInteresado}', [InteraccionController::class, 'obtenerPerrosRechazados']);
    Route::delete('deletePerro/{id}', [PerrosController::class, 'eliminarPerro']);
    Route::post('interaccion', [InteraccionController::class, 'registrarInteraccion']);
});

