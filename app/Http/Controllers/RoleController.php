<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->paginate(10);
        $rolePermissions = RolePermission::all();
        $permissions = Permission::all();
        return view('pages.Role.role-index', ['models' => $roles , 'permissions' => $permissions, 'rolePermissions' => $rolePermissions]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
        ]);

        $role = Role::create($data);
        return back();
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
        ]);

        $role->update($data);
        return back();
    }

    public function delete(Role $role)
    {
        $role->delete();
        return back();
    }

    
}
