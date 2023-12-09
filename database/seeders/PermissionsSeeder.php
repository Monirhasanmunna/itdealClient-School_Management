<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::updateOrCreate([
            'name' => 'dashboard',
            'group_name' => 'dashboard'
        ]);

        $userManagementPermissions = ['user_management','user_management.permissions','user_management.roles','user_management.users'];

        foreach ($userManagementPermissions as $key => $permission) {
            Permission::updateOrCreate([
                'name' => $permission,
                'group_name' => 'user_management'
            ]);
        }


        $studentPermission = ['student','student.setting','student.setting.academic year','student.setting.class','student.setting.shift','student.setting.section','student.setting.group','student.setting.student category',];

        foreach ($studentPermission as $key => $permission) {
            Permission::updateOrCreate([
                'name' => $permission,
                'group_name' => 'Student'
            ]);
        }

    }
}
