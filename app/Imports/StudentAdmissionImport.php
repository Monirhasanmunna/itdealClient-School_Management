<?php

namespace App\Imports;

use App\Helpers\Helper;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class StudentAdmissionImport implements ToCollection
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

    public function model(array $row)
    {
        foreach ($row as $value) {
            if (empty($value)) {
                return null;
            }
        }


        $existingStudent = Student::where('roll', $row['Roll'])->first();

        if (!$existingStudent) {
            return new Student([
                'unique_id'         => Helper::studentUniqueId(),
                'session_id'        => $this->session_id,
                'class_id'          => $this->class_id,
                'group_id'          => $this->group_id,
                'section_id'        => $this->section_id,
                'roll'              => $row['Roll'],
                'name'              => $row['Name'],
                'gender'            => $row['Gender'],
                'religion'          => $row['Religion'],
                'father_name'       => $row['Father Name'],
                'mother_name'       => $row['Mother Name'],
                'phone_number'      => $row['Mobile No'],
                'dob'               => $row['Date of Birth'],
                'blood_group'       => $row['Blood Group'],
                'guardian_phone'    => $row['Guardian Phone'],
                'district'          => $row['District'],
                'upazila'           => $row['Upazila'],
                'post_office'       => $row['Post Office'],
                'village'           => $row['Village'],
            ]);
        }

        return null; // Return null for existing records to skip them
    }


    /**
     * Specify the start row of the import.
     *
     * @return int
     */
    public function startRow(): int
    {
        return 2; // Skip header row, start importing from row 2
    }
}
