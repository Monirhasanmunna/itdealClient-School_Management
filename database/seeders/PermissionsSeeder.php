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

        
        $studentPermission = ['student','student.setting','student.setting.academic year','student.setting.class','student.setting.shift','student.setting.section','student.setting.group','student.setting.student category',];

        foreach ($studentPermission as $key => $permission) {
            Permission::updateOrCreate([
                'name' => $permission,
                'group_name' => 'Student'
            ]);
        }


        $subjectPermission = ['subject','subject-create','assign-to-class','assign-to-teacher','optional-subject-assign'];

        foreach ($subjectPermission as $key => $permission) {
            Permission::updateOrCreate([
                'name' => $permission,
                'group_name' => 'Subject'
            ]);
        }


        $HRMPermissions = ['HRM','Staff','Department','Designation'];

        foreach ($HRMPermissions as $key => $permission) {
            Permission::updateOrCreate([
                'name' => $permission,
                'group_name' => 'HRM'
            ]);
        }


        $ExpensePermissions = ['Expense','Expense Category','Expense Sub Category', 'Expense List'];

        foreach ($ExpensePermissions as $key => $permission) {
            Permission::updateOrCreate([
                'name' => $permission,
                'group_name' => 'Expense'
            ]);
        }


        $lotteryPermission = ['lottery','lottery-student-entry','draw-lottery','lottery-result'];

        foreach ($lotteryPermission as $key => $permission) {
            Permission::updateOrCreate([
                'name' => $permission,
                'group_name' => 'Lottery'
            ]);
        }


        $userManagementPermissions = ['user_management','user_management.permissions','user_management.roles','user_management.users'];

        foreach ($userManagementPermissions as $key => $permission) {
            Permission::updateOrCreate([
                'name' => $permission,
                'group_name' => 'user_management'
            ]);
        }

    }
}
