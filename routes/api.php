<?php

use App\Http\Controllers\VehiculoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/vehiculo',[VehiculoController::class,'index']);
Route::get('/vehiculo/{id}',[VehiculoController::class,'registro_unico']);
Route::post('/vehiculo',[VehiculoController::class,'store']);
Route::put('/vehiculo/{id}',[VehiculoController::class,'update']);
Route::delete('/vehiculo/{id}',[VehiculoController::class,'destroy']);
