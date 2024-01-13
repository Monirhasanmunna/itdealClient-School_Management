<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionsSeeder::class,
            RolesSeeder::class,
            UserSeeder::class,
            SessionSeeder::class,
            SectionSeeder::class,
            GroupSeeder::class,
            FixedSubjectSeeder::class,
            HrmDepartmentSeeder::class,
            ExpSeeder::class,
        ]);
        
    }
}
