<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','image','roll','phone_number','dob','class_id','session_id','section_id','group_id','religion','gender','blood_group','father_name','mother_name','guardian_phone','unique_id','district','upazila','post_office','village'];


    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function class()
    {
        return $this->belongsTo(AcademicClass::class,'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
