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

        $etihashchapter = [
            ['name' => 'আত্নপরিচয়', 'description' => 'লিখিত ও লিখিত উৎস থেকে তথ্য নিয়ে বিভিন্ন দৃষ্টিকোণ থেকে নিজের আত্নপরিচয় ও ইতিহাস অন্বেষন করেছে '],
            ['name' => 'মুক্তিযুদ্ধের চেতনা', 'description' => 'বিভিন্ন উৎস থেকে তথ্য নিয়ে মুক্তিযুদ্ধের সর্বস্তরের মানুষের আবদান অনুসন্ধান করেছে'],
            ['name' => 'প্রাকৃতিক ও সামাজিক কাঠামো', 'description' => 'বিভিন্ন প্রেক্ষাপটে গড়ে ওঠা সামাজিক ও রাজনৈতিক কাঠামো কীভাবে মানুষের অবস্থান ও ভূমিকা নির্ধারন করে তা অনুসন্ধান করেছে'],
            ['name' => 'সম্পদ ব্যবস্থাপনা', 'description' => 'সময় ও অঞ্চলভেদে অর্থনৈতিক ব্যবস্থা কীভাবে গড়ে ওঠে তা অনুসন্ধান করেছে'],
            ['name' => 'পরিবর্তনশীল ভুমিকায়', 'description' => 'সময় ও ভৌগলিক অবস্থানের সাপেক্ষে স্মাজের পরিবর্তন পর্যালোচনা করে নিজ প্রেক্ষাপটে দায়িত্বশীল আচরন করেছে '],
        ];

        $jibon_jibikachapter = [
            ['name' => 'আত্মউন্নয়ন', 'description' => 'নিজের পছন্দ ও সমক্ষমতা বিবেচনায় জীবনের লক্ষ্য নির্ধারন করে দায়িত্বশীল কাজে নিজেকে সম্পৃক্ত করতে পেরেছে'],
            ['name' => 'ক্যারিয়ার প্লানিং', 'description' => 'পেশার পরিবর্তন এবং তার সাথে সঙ্গে নতুন নতুন দক্ষতা অর্জনের প্রয়োজনীয়তা বুঝে তা অর্জনের জন্য নিজ প্রেক্ষাপটে সমস্যা সমাধানের চেষ্টা করেছে '],
            ['name' => 'পেশাগত দক্ষতা ', 'description' => 'নির্দিষ্ট পেশা সম্পর্কে মৌলিক ধারনা ও আগ্রহ প্রদর্শন করতে পেরেছে '],
            ['name' => 'ভবিষ্যৎ কর্মদক্ষতা ', 'description' => 'পেশায় ভবিষ্যৎ প্রযুক্তির প্রভাব জেনে অভিযোজনের প্রস্তুতি নিতে পেরেছে '],
        ];

        $dhormochapter = [
            ['name' => 'ধর্মীয় জ্ঞান', 'description' => 'ধর্মের মৌলিক বিষয়সমুহ জানতে আগ্রহ প্রদর্শন করেছে'],
            ['name' => 'ধর্মীয় বিধিবিধান', 'description' => 'ধর্মের বিধি বিধান উপলদ্ধি করে চর্চার চেষ্টা করেছে '],
            ['name' => 'ধর্মীয় মূল্যবোধ', 'description' => 'ধর্মীয় শিক্ষায় উদ্বুদ্ধ হয়ে সকলের সঙ্গে মিলেমিশে থেকেছে'],
           
        ];
        

        $shasto_shurokkhachapter = [
            ['name' => 'আত্মপরিচয়', 'description' => 'শারীরিক ও মানসিক পরিবর্তন উপলদ্ধি করে নিজের দৈনন্দিন যত্ন ও পরিচর্যা উদ্যেগী হয়েছে '],
            ['name' => 'আবেগীক বুদ্ধিমত্তা', 'description' => 'কাউকে কষ্ট না দিয়ে নিজের সামর্থ্য ও সক্ষমতা অনুযায়ী কাজ করেছে'],
            ['name' => 'সামাজিক বুদ্ধিমত্তা', 'description' => 'পারস্পারিক সম্পর্ক বজায় রাখতে পেরেছে '],
        ];

        $shilpo_shokskritiChapter = [
            ['name' => 'পর্যবেক্ষন ও রুপান্তর', 'description' => 'প্রকৃতির রুপ ও ঘটনাপ্রবাহ নিজের মতো করে বিভিন্নভাবে প্রকাশের আগ্রহ প্রদর্শন করেছে'],
            ['name' => 'নান্দিকতার বহুমাত্রিক প্রকাশ', 'description' => 'শিল্পকলার বিভিন্না ধারার পরিবেশনা উপভোগ করতে পারছে এবং সম্পৃক্ত হতে আগ্রহ প্রকাশ করেছে'],
            ['name' => 'যাপিত জীবনে নান্দনিকতা', 'description' => 'দৈনন্দিন কার্যক্রমে নানন্দিকতার প্রকাশ করেছে'],
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


       $etihash = FixedSubject::updateOrCreate([ 'name' => 'ইতিহাস ও সামাজিক বিজ্ঞান' ]);

        foreach ($etihashchapter as $chptr) {
            Chapter::create([
                'subject_id' => $etihash->id,
                'name' => $chptr['name'],
                'description' => $chptr['description']
            ]);
        }


       $jibon_jibika = FixedSubject::updateOrCreate([ 'name' => 'জীবন ও জীবিকা' ]);

        foreach ($jibon_jibikachapter as $chptr) {
            Chapter::create([
                'subject_id' => $jibon_jibika->id,
                'name' => $chptr['name'],
                'description' => $chptr['description']
            ]);
        }


       $dhormo = FixedSubject::updateOrCreate([ 'name' => 'ধর্ম শিক্ষা' ]);

        foreach ($dhormochapter as $chptr) {
            Chapter::create([
                'subject_id' => $dhormo->id,
                'name' => $chptr['name'],
                'description' => $chptr['description']
            ]);
        }

       $shasto_shurokkha = FixedSubject::updateOrCreate([ 'name' => 'স্বাস্থ্য সুরক্ষা' ]);

        foreach ($shasto_shurokkhachapter as $chptr) {
            Chapter::create([
                'subject_id' => $shasto_shurokkha->id,
                'name' => $chptr['name'],
                'description' => $chptr['description']
            ]);
        }


       $shilpo_shonkskriti = FixedSubject::updateOrCreate([ 'name' => 'শিল্প ও সংস্কৃতি' ]);

        foreach ($shilpo_shokskritiChapter as $chptr) {
            Chapter::create([
                'subject_id' => $shilpo_shonkskriti->id,
                'name' => $chptr['name'],
                'description' => $chptr['description']
            ]);
        }
    }
}

