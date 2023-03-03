<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public static function getGroupPermissions($group) {

        $permissions = [
            'admin'         => ['users:manage', 'prestadores:manage', 'empresas:manage', 'visitas:manager'],
            'supervisor'    => ['users:create', 'users:update', 'users:editme', 'empresas:manage', 'prestadores:manage', 'visitas:manager'],
            'porteiro'      => ['users:editme', 'prestadores:create', 'prestadores:update', 'visitas:create', 'visitas:update'],
        ]; 

        return $permissions[$group];
    }
    
}
