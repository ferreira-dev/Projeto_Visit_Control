<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreUser;
use App\Models\User;
use App\Http\Controllers\Api\PermissionsController as Permissions;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store(StoreUser $request)
    {
        // if (!$request->user()->tokenCan('user:manager')) {
        //     abort(403, 'não autorizado');
        // }


        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        
        $user = $this->model->create($data);
        
        $permissions = Permissions::getGroupPermissions($request->group);

        $token = $user->createToken($request->device_name, $permissions)->plainTextToken;


        return response()->json(['success' => true, 'user' => $user, 'token' => $token]);
    }
}
