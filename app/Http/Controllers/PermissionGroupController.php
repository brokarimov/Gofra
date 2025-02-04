<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;

class PermissionGroupController extends Controller
{
    public function index()
    {
        $permissionGroups = PermissionGroup::orderBy('id', 'desc')->paginate(10);
        return view('pages.Permission.permission-group-index', ['models' => $permissionGroups]);
    }

    public function status(PermissionGroup $group)
    {
        // Toggle the group's status
        $newStatus = $group->status == 1 ? 0 : 1;

        // Update the group's status
        $group->update(['status' => $newStatus]);

        // Bulk update all related permissions
        $group->permissions()->update(['status' => $newStatus]);

        return back();
    }
}
