<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    protected $fillable = [
        'name',
        'status'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'group_id');
    }
}
