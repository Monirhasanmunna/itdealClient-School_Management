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

        $banglaChapters = [
            ['name' => 'যোগাযোগ', 'description' => 'পরিস্থিতি বিবেচনায় প্রমিত ভাষায় যোগাযোগ করেছে '],
            ['name' => 'ভাষারীতি', 'description' => 'বিভিন্ন ধরনের লেখা পড়ে লেখকের দৃষ্টিভঙ্গি উপলদ্ধি করেছে এবং নিজের বক্তব্য বোঝাতে বিভিন্ন অর্থবৈচিত্রমূলক বাক্য তৈরি করেছে'],
            ['name' => 'প্রায়োগিক যোগাযোগ', 'description' => 'বিশ্লেষণাত্মক ভাষায় লিখতে পেরেছে '],
            ['name' => 'সৃজনশীল ও মননশীল প্রকাশ', 'description' => 'সাহিত্যরস উপভোগ করে নিজের কল্পনা ও অনুভুতি সৃষ্টিশীল উপায়ে প্রকাশ করেছে'],
            ['name' => 'মানবিক চিন্তা', 'description' => 'কোন ঘটনা বা বিষয় সম্পর্কে নিজের মত দিয়েছে ও অন্যের মতের গঠনমূলক সমোলোচনা করেছে।'],
        ];

        $englishchapters = [
            ['name' => 'Communication', 'description' => 'Communication with relevance to a given context'],
            ['name' => 'Linguistic norms', 'description' => 'Uses appropriate vocabulary and expression as required in the context'],
            ['name' => 'Democratic practice', 'description' => 'Values democratic atmosphere in communication and participates according.'],
            ['name' => 'Creative Expression', 'description' => 'Comprehends and relates to literary texts'],
        ];


        $mathchapters = [
            ['name' => 'গানিতিক অনুসন্ধান', 'description' => 'সমস্যা সমাধানে বিভিন্ন গানিতিক অনুসন্ধান প্রক্রিয়া যাচাই করেছে'],
            ['name' => 'সংখ্যা ও পরিমাণ', 'description' => 'গানিতিক সমস্যা সমাধানে যথাযথ ভাষা ও কৌশলের প্রয়োগ করেছে'],
            ['name' => 'জ্যামিতিক আকৃতি', 'description' => 'নিয়মিত জ্যামিতিক আকৃতি চিনতে পেরেছে এবং সেগুলো পরিমাপ করতে পেরেছে'],
            ['name' => 'গানিতিক সম্পর্ক', 'description' => 'সমস্যা সমাধানে গাণিতিক যুক্তি ও সুত্র ব্যবহার করেছে '],
            ['name' => 'সম্ভাব্যতা বিশ্লেষন', 'description' => 'প্রাপ্ত তথ্য বিশ্লেষন করে সমস্যা সমাধানের সম্ভাবনা যাচাই করে দেখেছে'],
        ];

        $sciencechapters = [
            ['name' => 'বৈজ্ঞানিক অনুসন্ধান', 'description' => 'বৈজ্ঞানিক অনুসন্ধানের ক্ষেত্রে তথ্য প্রমাণ ও বস্তুনিষ্ঠার উপর জোর দিয়েছে'],
            ['name' => 'বস্তুর গঠন ও আচরন', 'description' => 'পরিবেশের বিভিন্ন বস্তুর বাহ্যিক গঠন ও আচরনের সম্পর্কে অনুসন্ধান করেছে'],
            ['name' => 'বস্তু ও শক্তির মিথস্ক্রিয়া', 'description' => 'বিভিন্ন প্রাকৃতিক ঘটনায় শক্তির স্থানান্তর অনুসন্ধান করেছে '],
            ['name' => 'স্থিতি ও পরিবর্তন', 'description' => 'কোন সিস্টেমে ঘটে চলা বিভিন্ন পরিবর্তনের মধ্য দিয়ে যে ভারসাম্যের সৃষ্টি হয় তা অনুসন্ধান করেছে '],
            ['name' => 'বিজ্ঞানলব্ধ সামাজিক মূল্যবোধ', 'description' => 'মানুষ ও প্রকৃতির উপর প্রভাব বিবেচনায় নিয়ে বিজ্ঞান ও প্রযুক্তির ইতিবাচক প্রয়োগে সচেষ্ট হয়েছে'],
        ];

        $digitaltechchapters = [
            ['name' => 'ডিজিটাল সাক্ষরতা', 'description' => 'প্রযুক্তির সাহায্যে প্রয়োজনীয় তথ্য সংগ্রহ ও তথ্যের দায়িত্বশীল ব্যবহার করতে পেরেছে '],
            ['name' => 'আইসিটি সক্ষমতা', 'description' => 'ব্যক্তিগত প্রয়োজনে ডিজিটাল মাধ্যেম ব্যবহার করে জরুরী সেবা গ্রহনের জন্য যোগাযোগ করেছে '],
            ['name' => 'ডিজিটাল সলিউশন', 'description' => 'উদ্ভাবন এলগরিদম ব্যবহার করে প্রোগ্রাম তৈরি করেছে এবং বিভিন্ন ধরনের নেটওয়ার্ক তথ্য আদানপ্রদানের কৌশল ব্যাখ্যা করেছে '],
        ];



       $bangla = FixedSubject::updateOrCreate([ 'name' => 'বাংলা' ]);

        foreach ($banglaChapters as $chptr) {
            Chapter::create([
                'subject_id' => $bangla->id,
                'name' => $chptr['name'],
                'description' => $chptr['description']
            ]);
        }

       $english = FixedSubject::updateOrCreate([ 'name' => 'English' ]);

        foreach ($englishchapters as $chptr) {
            Chapter::create([
                'subject_id' => $english->id,
                'name' => $chptr['name'],
                'description' => $chptr['description']
            ]);
        }


       $math = FixedSubject::updateOrCreate([ 'name' => 'গণিত' ]);

        foreach ($mathchapters as $chptr) {
            Chapter::create([
                'subject_id' => $math->id,
                'name' => $chptr['name'],
                'description' => $chptr['description']
            ]);
        }


       $science = FixedSubject::updateOrCreate([ 'name' => 'বিজ্ঞান' ]);

        foreach ($sciencechapters as $chptr) {
            Chapter::create([
                'subject_id' => $science->id,
                'name' => $chptr['name'],
                'description' => $chptr['description']
            ]);
        }


       $digitaltecq = FixedSubject::updateOrCreate([ 'name' => 'ডিজিটাল প্রযুক্তি' ]);

        foreach ($digitaltechchapters as $chptr) {
            Chapter::create([
                'subject_id' => $digitaltecq->id,
                'name' => $chptr['name'],
                'description' => $chptr['description']
            ]);
        }
    }
}

