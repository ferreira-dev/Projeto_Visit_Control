<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\PermissionsController as Permissions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function login(AuthUser $request)
    {
        $user = $this->model->where('email', $request->email)->firstOrFail();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'Usuário ou senha inválido(s). '
            ]);
        }

        $permissions = Permissions::getGroupPermissions($user->group);
        $token = $user->createToken($request->device_name, $permissions)->plainTextToken;

        return response()->json([
            'user'       => $user,
            'token'      => $token,
            'permissoes' => ''
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'logout' => 'success'
        ]);
        //é necessário passar o token no Body da requisição
    }

    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => $user,
            'currentAccessToken' => $user->currentAccessToken(),
            'permissions' => $user->currentAccessToken()->abilities,
        ]);
    }
}
