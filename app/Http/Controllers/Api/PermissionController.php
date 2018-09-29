<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function createRoles(Request $request)
    {
        $name = $request->get('name');

        $role = Role::create(['name' => $name]);

        pd_var($role);
    }

    public function createPermission(Request $request)
    {
        $name = $request->get('name');

        $permission = Permission::create(['name' => $name]);

        pd_var($permission);
    }
}
