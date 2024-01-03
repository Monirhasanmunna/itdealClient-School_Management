<?php

namespace Database\Seeders;

use App\Models\HrmDepartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HrmDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = ['Teacher', 'Staff', 'Committee'];

        foreach ($departments as $key => $department) {
            HrmDepartment::updateOrCreate([
                'name' => $department
            ]);
        }
    }
}
