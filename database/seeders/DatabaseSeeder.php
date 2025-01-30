<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use App\Models\User;
use Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Route;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $role = Role::create([
            'name' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12345678),
            'role_id' => $role->id
        ]);

        $permissionGroup = PermissionGroup::create([
            'name' => 'HR'
        ]);

        $routes = Route::getRoutes();
        foreach($routes as $route){
            $key = $route->getName();
            if($key && !str_starts_with($key, 'generated::') && $key !== 'storage.local'){
                $name = ucfirst(str_replace('.', '-', $key));

                Permission::create([
                    'name' => $name,
                    'key' => $key,
                    'group_id' => $permissionGroup->id
                ]);
            }
        }
        $permissions = Permission::all()->pluck('id');
        $role->permissions()->attach($permissions);
    }

    
}
