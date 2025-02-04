<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class RefreshPermissions extends Command
{
    protected $signature = 'app:refresh-permissions';

    protected $description = 'Refresh permissions for all routes';

    public function handle()
    {
        $this->info('Refreshing permissions...');

        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            $this->processRoute($route);
        }

        $this->info('Permissions refreshed successfully!');
    }

    protected function processRoute($route)
    {
        $key = $route->getName();
        if ($key && !str_starts_with($key, 'generated::') && $key !== 'storage.local') {
            $group = $this->getOrCreatePermissionGroup($route);

            $name = ucfirst(str_replace('.', ' ', $key));

            $this->createPermissionForGroup($group, $name, $key);
        }
    }

    protected function getOrCreatePermissionGroup($route)
    {
        $prefix = $route->getPrefix();

        if (!$prefix) {
            $prefix = 'main';  
        } else {
            $prefix = ltrim($prefix, '/');  
        }

        return PermissionGroup::firstOrCreate(['name' => $prefix]);
    }

    protected function createPermissionForGroup($group, $name, $key)
    {
        Permission::firstOrCreate([
            'name' => $name,
            'key' => $key,
            'group_id' => $group->id,
        ]);
    }
}
