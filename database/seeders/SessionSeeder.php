<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sessions = ['2021','2022','2023','2024','2025','2025'];

        foreach ($sessions as $key => $session) {
            Session::updateOrCreate([
                'session_year' => $session
            ]);
        }
    }
}
