<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //
        $resources = [
            'role' => 'Role',
            'user' => 'User',
            'slider' => 'Slider',
            'contact' => 'Contact',
        ];

        $actions = [
            'list' => 'Show',
            'create' => 'Add',
            'edit' => 'Edit',
            'delete' => 'Delete',
        ];

        $permissions = [];

        foreach ($resources as $key => $name) {
            foreach ($actions as $actionKey => $actionName) {
                $permissions[] = [
                    'name' => "{$key}-{$actionKey}",
                    'display_name' => "{$actionName} {$name}",
                    'guard_name' => 'web',
                ];
            }
        }

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name'], 'guard_name' => $permission['guard_name']],
                $permission
            );
        }
    }
}
