<?php

namespace App\Helpers;

use App\Models\Student;

class Helper{
    public static function studentUniqueId()
    {
        $year = date('y'); // Last two digits of the year
        $month = date('m'); // Month
        $day = date('d');   // Day

        $student_id = Student::orderBy('id', 'desc')->value('id') ?? 0;

        $student_id++;

        // Generating the padded student ID
        $paddedStudentId = str_pad($student_id, 4, '0', STR_PAD_LEFT);

        // Constructing the unique student ID
        $uniqueID = $year . $month . $day . $paddedStudentId;

        // The generated unique ID
        return $uniqueID;
    }
}