<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function assignPermission(Request $request, $roleId)
    {
        // Validasi request
        $request->validate([
            'permissions' => 'required|array', // permissions adalah array dari permission yang diberikan
            'permissions.*' => 'string', // Setiap permission harus berupa string
        ]);

        // Cek apakah role yang dimaksud adalah 'admin'
        if ($roleId !== 'admin') {
            return response()->json(['message' => 'Invalid role'], 400);
        }

        // Cari role berdasarkan nama
        $role = Role::findByName($roleId);

        // Iterasi melalui setiap permission yang diberikan
        foreach ($request->input('permissions') as $permissionName) {
            // Mencari atau membuat permission jika belum ada
            $permission = Permission::where('name', $permissionName)->first();
            if (!$permission) {
                $permission = Permission::create(['name' => $permissionName]);
            }

            // Berikan permission kepada role
            $role->givePermissionTo($permission);
        }

        // Response sukses
        return response()->json(['message' => 'Permissions assigned to role successfully'], 200);
    }
}
