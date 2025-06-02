<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;


Route::get('/teste', function () {
    return response()->json(['mensagem' => 'API funcionando!']);
});


Route::apiResource('clientes', ClienteController::class);

use App\Http\Controllers\MarcaController;
Route::apiResource('marcas', MarcaController::class);

use App\Http\Controllers\ProdutoController;
Route::apiResource('produtos', ProdutoController::class);

use App\Http\Controllers\VendaController;
Route::apiResource('vendas', VendaController::class);