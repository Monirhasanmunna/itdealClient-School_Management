<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected  $fillable = ['id','name','subject_code','subject_type','status','created_at','updated_at'];


    public function classes()
    {
        return $this->belongsToMany(AcademicClass::class, 'class_subjects', 'subject_id', 'class_id');
    }

}
