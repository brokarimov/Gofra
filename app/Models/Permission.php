<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'key',
        'group_id',
        'status',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'permission_id', 'role_id');
    }

    public function permissionGroup()
    {
        return $this->belongsTo(PermissionGroup::class, 'group_id');
    }
}
