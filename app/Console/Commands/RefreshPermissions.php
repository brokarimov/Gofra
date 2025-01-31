<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class RefreshPermissions extends Command
{
    // The name and signature of the console command.
    protected $signature = 'app:refresh-permissions';

    // The console command description.
    protected $description = 'Refresh permissions for all routes';

    // Execute the console command.
    public function handle()
    {
        $this->info('Refreshing permissions...');

        // Retrieve all routes
        $routes = Route::getRoutes();

        // Loop through the routes and process them
        foreach ($routes as $route) {
            $this->processRoute($route);
        }

        $this->info('Permissions refreshed successfully!');
    }

    // Process each route to create permissions
    protected function processRoute($route)
    {
        $key = $route->getName();
        if ($key && !str_starts_with($key, 'generated::') && $key !== 'storage.local') {
            // Get the route's permission group
            $group = $this->getOrCreatePermissionGroup($route);

            // Convert route name into permission name
            $name = ucfirst(str_replace('.', ' ', $key));

            // Create permission for the route
            $this->createPermissionForGroup($group, $name, $key);
        }
    }

    // Get or create a PermissionGroup based on the route's prefix or assign a default group
    protected function getOrCreatePermissionGroup($route)
    {
        // Check for a prefix in the route
        $prefix = $route->getPrefix();

        // If there's no prefix, set a default (e.g., "main")
        if (!$prefix) {
            $prefix = 'main';  // Assign a default group for routes without prefix
        } else {
            $prefix = ltrim($prefix, '/');  // Remove leading slash if prefix exists
        }

        // Check if PermissionGroup already exists or create one
        return PermissionGroup::firstOrCreate(['name' => $prefix]);
    }

    // Create a permission and associate it with a group
    protected function createPermissionForGroup($group, $name, $key)
    {
        // Check if the permission already exists in the group
        Permission::firstOrCreate([
            'name' => $name,
            'key' => $key,
            'group_id' => $group->id,
        ]);
    }
}
