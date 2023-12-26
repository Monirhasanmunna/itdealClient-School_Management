<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\FixedSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FixedSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // 'বাংলা','English','গণিত','বিজ্ঞান','ডিজিটাল প্রজুক্তি','ইতিহাস ও সামাজিক বিজ্ঞান','জীবন ও জীবিকা','ধর্ম শিক্ষা','স্বাস্থ্য সুরক্ষা','শিল্প ও সংস্কৃতি'

        $banglaChapters = [
            ['name' => 'যোগাযোগ', 'description' => 'পরিস্থিতি বিবেচনায় প্রমিত ভাষায় যোগাযোগ করেছে'],
            ['name' => 'ভাষারীতি', 'description' => 'বিভিন্ন ধরনের লেখা পড়ে লেখকের দৃষ্টিভঙ্গি উপলব্ধি করেছে এবং নিজের বক্তব্য বোঝাতে বিভিন্ন অর্থবইচিত্র্যমূলক বাক্য তৈরি করেছে'],
            ['name' => 'প্রেয়োগিক যোগাযোগ', 'description' => 'বিশ্লেষণাত্তক ভাষায় লিখতে পেরেছে'],
            ['name' => 'সৃজনশীল ও মননশীল প্রকাশ', 'description' => 'সাহিত্যরস উপভোগ করে লিজের কল্পনা ও অনুভূতি সৃষ্টিশীল উপায়ে প্রকাশ করেছে'],
            ['name' => 'মানবিক চিন্তন', 'description' => 'কোনো ঘটনা বা বিষয় সিম্পর্কে নিজের মত দিয়েছে ও অন্যের মতে গঠনমূল সমালোচনা করেছে'],
        ];

        $english = [
            ['name' => 'Communication', 'description' => 'Communicates with relavance to a gives context'],
            ['name' => 'Linguistic norms', 'description' => 'Uses appropriate vocabulary and expressions as required in the context'],
            ['name' => 'Democratic practice', 'description' => 'Values democratic atmosphere in communication and participates accordingly'],
            ['name' => 'Creative expression', 'description' => 'Comprehends and relates to literary texts'],
        ];


       $subject1 = FixedSubject::updateOrCreate([
            'name' => 'বাংলা'
        ]);

        foreach ($banglaChapters as $chptr) {
            Chapter::create([
                'subject_id' => $subject1->id,
                'name' => $chptr['name'],
                'description' => $chptr['description']
            ]);
        }

       $subject2 = FixedSubject::updateOrCreate([
            'name' => 'English'
        ]);

        foreach ($english as $chptr) {
            Chapter::create([
                'subject_id' => $subject2->id,
                'name' => $chptr['name'],
                'description' => $chptr['description']
            ]);
        }
    }
}

