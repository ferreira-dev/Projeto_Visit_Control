<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreUser;
use App\Models\User;
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
        
        $permissions = $this->getGroupPermissions($request->group);

        $token = $user->createToken($request->device_name, $permissions)->plainTextToken;


        return response()->json(['success' => true, 'user' => $user, 'token' => $token]);
    }

    private function getGroupPermissions($group) {

        $permissions = [
            'admin'         => ['users:manage', 'prestadores:manage', 'empresas:manage', 'visitas:manager'],
            'supervisor'    => ['users:create', 'users:update', 'users:editme', 'empresas:manage', 'prestadores:manage', 'visitas:manager'],
            'porteiro'      => ['users:editme', 'prestadores:create', 'prestadores:update', 'visitas:create', 'visitas:update'],
        ]; 

        return $permissions[$group];
    }
}
