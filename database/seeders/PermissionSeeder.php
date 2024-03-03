<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::firstOrCreate(['name' => 'users.index']);
        Permission::firstOrCreate(['name' => 'users.create']);
        Permission::firstOrCreate(['name' => 'users.edit']);
        Permission::firstOrCreate(['name' => 'users.delete']);
        Permission::firstOrCreate(['name' => 'lomba.create']);
        Permission::firstOrCreate(['name' => 'lomba.edit']);
        Permission::firstOrCreate(['name' => 'lomba.delete']);
        Permission::firstOrCreate(['name' => 'jadwal.create']);
        Permission::firstOrCreate(['name' => 'jadwal.edit']);
        Permission::firstOrCreate(['name' => 'jadwal.delete']);

        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->givePermissionTo([
            'users.create',
            'users.edit',
            'users.delete',
            'lomba.create',
            'lomba.edit',
            'lomba.delete',
            'jadwal.create',
            'jadwal.edit',
            'jadwal.delete'
        ]);

        $userRole = Role::where('name', 'user')->first();
        $userRole->givePermissionTo([
            'users.index'
        ]);
    }
}