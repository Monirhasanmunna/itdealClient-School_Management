<?php

namespace Database\Seeders;

use App\Models\ExpCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExpCategory::updateOrCreate([
            'name' => 'utilities',
        ]);

        ExpCategory::updateOrCreate([
            'name' => 'Salary',
        ]);
    }
}
