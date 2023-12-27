<?php

namespace App\Imports;

use App\Helpers\Helper;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentAdmission2Import implements ToCollection
{
    protected $session_id;
    protected $class_id;
    protected $section_id;
    protected $group_id;

    public function __construct($session, $class, $section, $group)
    {
        $this->session_id   = $session;
        $this->class_id     = $class;
        $this->section_id   = $section;
        $this->group_id     = $group;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $rows = $collection->reject(function ($row) {
            return empty(array_filter($row->toArray()));
        })->slice(1);

        $existingAdmission = Student::pluck('roll')->toArray();

        foreach ($rows as $key => $row) 
        {
            $newAdmission = $row[0];

            if(!in_array($newAdmission, $existingAdmission)){
                Student::create([
                'unique_id'         => Helper::studentUniqueId(),
                'session_id'        => $this->session_id,
                'class_id'          => $this->class_id,
                'group_id'          => $this->group_id,
                'section_id'        => $this->section_id,
                'roll'              => $row[0],
                'name'              => $row[1],
                'gender'            => $row[2],
                'religion'          => $row[3],
                'father_name'       => $row[4],
                'mother_name'       => $row[5],
                'phone_number'      => $row[6],
                'blood_group'       => $row[7],
                'guardian_phone'    => $row[8],
                'district'          => $row[9],
                'upazila'           => $row[10],
                'post_office'       => $row[11],
                'village'           => $row[12],
                ]);
            }else{
                continue;
            }
        }
    }
}
