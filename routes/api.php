<?php

use App\Http\Controllers\api\bi\AnaliseFreteMLController;
use App\Http\Controllers\api\mercadolivre\MercadoLivreController;
use App\Http\Controllers\api\mercadolivre\MercadoLivreShipmentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/v1/register', [AuthController::class, 'register']);
Route::post('/v1/login', [AuthController::class, 'login']);

## Autenticados
Route::middleware('auth:api')->group(function () {

    # Usuarios
    Route::get('/v1/user', [AuthController::class, 'user']); ## Mostra usuario logado
    Route::post('/v1/logout', [AuthController::class, 'logout']);  ## Invalida token fazendo com que usuario deslogue
    Route::get('/v1/users', [AuthController::class, 'users']);  ## Lista todos os usuarios 

    # Mercado Livre
    Route::post('/v1/analiseFreteML/insere', [AnaliseFreteMLController::class, 'insereDados']);  ## Insere os dados de analise de fretes 
    Route::get('/v1/analiseFreteML/lista', [AnaliseFreteMLController::class, 'listaDados']);  ## Lista todos os dados de analise de fretes 
    Route::post('/v1/mercadolivre/orders', [MercadoLivreController::class, 'store']); ## Insere todos os dados das ordens  
    Route::post('/v1/mercadolivre/shipments', [MercadoLivreShipmentController::class, 'store']); ## Insere todos os dados dos envios  
});
