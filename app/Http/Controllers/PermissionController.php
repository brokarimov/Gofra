<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionRequset;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function givePermission(Role $role, PermissionRequset $request)
    {
        $existingRolePermission = RolePermission::where('role_id', $role->id)->first();
        if (!$existingRolePermission) {
            $data = $request->permissions;
            $role->permissions()->attach($data);
        }else{
            $data = $request->permissions;
            $role->permissions()->sync($data);
        }

        return back();
    }
}
