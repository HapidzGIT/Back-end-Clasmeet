<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {
        // Membuat user admin
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Mencari role admin
        $adminRole = Role::where('name', 'admin')->first();

        // Memberikan role admin ke user admin
        $admin->assignRole($adminRole);

        // Membuat user biasa
        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Mencari role user
        $userRole = Role::where('name', 'user')->first();

        // Memberikan role user ke user biasa
        $user->assignRole($userRole);
    }
}
