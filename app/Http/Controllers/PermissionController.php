<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionRequset;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Role $role)
    {
        $permissionGroups = PermissionGroup::where('status', 1)->get();
        $permissions = Permission::where('status', 1)->get();
        $rolePermissions = RolePermission::all();

        return view('pages.Role.role-permission-index', ['role' => $role, 'permissionGroups' => $permissionGroups, 'permissions' => $permissions, 'rolePermissions' => $rolePermissions]);
    }

    public function givePermission(Role $role, PermissionRequset $request)
    {
        $existingRolePermission = RolePermission::where('role_id', $role->id)->first();
        if (!$existingRolePermission) {
            $data = $request->permissions;
            $role->permissions()->attach($data);
        } else {
            $data = $request->permissions;
            $role->permissions()->sync($data);
        }

        return redirect()->route('permission.index', $role->id);
    }

    public function status(PermissionGroup $group, Request $request)
    {
        $allPermissionIDs = Permission::where('group_id', $group->id)->pluck('id')->toArray();

        $checkedIDs = $request->permissions ?? [];

        Permission::whereIn('id', $checkedIDs)->update(['status' => 1]);

        $uncheckedIDs = array_diff($allPermissionIDs, $checkedIDs);
        Permission::whereIn('id', $uncheckedIDs)->update(['status' => 0]);

        return back();
    }
}
