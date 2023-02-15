<?php

use App\Http\Controllers\Api\EmpresaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::post('/register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'store']); //só usar na criação inicial do projeto

/*
|---------------------------------------
| Rotas de Autenticação / Registro      |
|---------------------------------------
*/

Route::post('/login', [App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'store'])->middleware('auth:sanctum');
Route::post('/logout', [App\Http\Controllers\Api\Auth\AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [App\Http\Controllers\Api\Auth\AuthController::class, 'me'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {

/*
|---------------------------------------
|       Rotas de Usuário                |
|---------------------------------------
*/
    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\User\UserController::class, 'getAll']);
        Route::get('/{id}', [App\Http\Controllers\Api\User\UserController::class, 'show']);
        Route::put('/{id}', [App\Http\Controllers\Api\User\UserController::class, 'update']);
        Route::put('/changepassword/{id}', [App\Http\Controllers\Api\User\UserController::class, 'changePassword']);
    });

/*
|---------------------------------------
|          Rotas de Empresas            |
|---------------------------------------
*/
    Route::prefix('empresas')->group(function () {
        Route::apiResource('/', EmpresaController::class);
    });
});
