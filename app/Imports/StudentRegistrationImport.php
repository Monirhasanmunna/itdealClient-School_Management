<?php

namespace App\Imports;

use App\Models\LotteryStudent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentRegistrationImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $rows = $collection->reject(function ($row) {
            return empty(array_filter($row->toArray()));
        })->slice(1);

        $existingApplicant = LotteryStudent::pluck('applicant_id')->toArray();

        foreach ($rows as $key => $row) 
        {
            $newApplicantId = $row[0];

            if(!in_array($newApplicantId, $existingApplicant)){
                LotteryStudent::create([
                    'applicant_id'  => $row[0],
                    'name'          => $row[1],
                    'gender'        => $row[2],
                    'religion'      => $row[3],
                    'father_name'   => $row[4],
                    'mother_name'   => $row[5],
                    'phone_number'  => $row[6],
                ]);
            }else{
                continue;
            }
        }
    }
}
