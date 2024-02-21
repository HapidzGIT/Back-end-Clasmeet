<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void 
     */
    public function run(): void
    {
         Role::create([
        'name' => 'admin',
        'guard_name' => 'web'
       ]);

       Role::create([
        'name' => 'user',
        'guard_name' => 'web'
       ]);
      
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
    }
}
