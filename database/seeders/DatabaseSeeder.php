<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(AccountSeeder::class);
        $this->call(GovernorSeeder::class);
        $this->call(VisitorSeeder::class);
    }
}
