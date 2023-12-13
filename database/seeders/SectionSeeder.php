<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = ['Shapla','Golap','Joba'];

        foreach ($sections as $key => $section) {
            Section::updateOrCreate([
                'name' => $section
            ]);
        }
    }
}
