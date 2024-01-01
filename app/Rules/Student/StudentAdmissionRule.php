<?php

namespace App\Rules\Student;

use App\Models\Student;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StudentAdmissionRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $session_id = request('session_id');
        $class_id = request('class_id');
        $group_id = request('group_id');
        $section_id = request('section_id');
        $roll = request('roll');

    
        if(isset($group_id)){
            $student = Student::where('session_id', $session_id)
                        ->where('class_id', $class_id)
                        ->where('group_id', $group_id)
                        ->where('roll', $roll)->count();

            if($student > 0){
                $fail('This roll already exists in this group');
            }
        }else{
            $student = Student::where('session_id', $session_id)
                    ->where('class_id', $class_id)
                    ->where('section_id', $section_id)
                    ->where('roll', $roll)->count();

            if($student > 0){
                $fail('This roll already exists in this section');
            }
        }
    }
}
