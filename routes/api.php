<?php

use App\Http\Controllers\Api\EmpresaController;
use Illuminate\Http\Request;
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


/* rotas de autenticação / registro  */

Route::post('/login', [App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\Api\Auth\RegisterController::class, 'store'])->middleware('auth:sanctum');
Route::post('/logout', [App\Http\Controllers\Api\Auth\AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [App\Http\Controllers\Api\Auth\AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    //rotas de usuário
    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\User\UserController::class, 'getAll']);
        Route::get('/{id}', [App\Http\Controllers\Api\User\UserController::class, 'show']);
        Route::get('/mypermissions', [App\Http\Controllers\Api\PermissionsController::class, 'getMyPermissions']);
    });

    //rotas de empresas
    Route::prefix('empresas')->group(function () {
        Route::apiResource('/', EmpresaController::class);
    });
});
