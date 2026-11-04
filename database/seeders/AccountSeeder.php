<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //
        $user = User::create([
            "name" => "Admin",
            'email' => "govehousekp@info.com",
            'password' => bcrypt('govehousekpinfo'),
        ]);

        $role = \Spatie\Permission\Models\Role::where('name', 'Admin')->first();
        $user->assignRole($role);
    }
}
