<?php

namespace App\Helpers;

use App\Models\LotteryStudent;

class Helper{
    public static function applicantUniqueId()
    {
        $year = date('Y');
        $day = date('d');
        $lastTwoDigit = substr($year, -2);

        $lastApplicantId = LotteryStudent::orderBy('id','desc')->first()->id;
        
        $applicandId = $lastTwoDigit.'00000'.$lastApplicantId;
        $uniqueID = $lastTwoDigit . $day . str_pad($lastApplicantId, 6, '0', STR_PAD_LEFT);

        dd($uniqueID);
    }
}