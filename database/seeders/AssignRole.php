<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminrole = Role::where('name','admin')->first();
        $userrole = Role::where('name','user')->first();

        $usersindex = Permission::where('name','users.index');
        $userscreate = Permission::where('name','users.create');
        $usersedit = Permission::where('name','users.edit');

        $adminrole-> givePermissionTo([$usersindex,$userscreate,$usersedit]);
    }
}
