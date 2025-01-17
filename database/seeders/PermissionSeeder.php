<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $role = [
            [
                //
                'name' => 'superadmin',
                'guard_name' => 'web',
                'permissions' => [
                    'read.only.superadmin'
                ]
            ],
            [
                //
                'name' => 'supervisor',
                'guard_name' => 'web',
                'permissions' => [
                    'only.supervisor'
                ]
            ],
            [
                //
                'name' => 'mahasiswa',
                'guard_name' => 'web',
                'permissions' => [
                    'read.only.mahasiswa'
                ]
            ],
        ];
        
        foreach ($role as $key => $value) {
            $role = Role::findOrCreate($value['name'], $value['guard_name']);

            if (isset($value['permissions'])) {
                foreach ($value['permissions'] as $k => $v) {
                    
                    $permission = Permission::findOrCreate($v);
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
}
