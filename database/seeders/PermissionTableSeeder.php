<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user-list', 'user-create', 'user-edit', 'user-delete',
            'role-list', 'role-create', 'role-edit', 'role-delete',
            'slider-list', 'slider-create', 'slider-edit', 'slider-delete',
            'global-impact-list', 'global-impact-create', 'global-impact-edit', 'global-impact-delete',
            'governor-message-list', 'governor-message-create', 'governor-message-edit', 'governor-message-delete',
            'key-initiative-list', 'key-initiative-create', 'key-initiative-edit', 'key-initiative-delete',
            'talk-to-governor-list', 'talk-to-governor-delete',
            'contact-us-list', 'contact-us-delete',
            'new-and-event-list', 'new-and-event-create', 'new-and-event-edit', 'new-and-event-delete',
            'governor-list', 'governor-create', 'governor-edit', 'governor-delete',
            'secretary-list', 'secretary-create', 'secretary-edit', 'secretary-delete',
            'newsletter-list', 'newsletter-create', 'newsletter-edit', 'newsletter-delete',
            'visitor-list', 'visitor-create', 'visitor-edit', 'visitor-delete'
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
