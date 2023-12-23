<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected  $fillable = ['id','name','subject_code','subject_type','status','created_at','updated_at'];


    public function class()
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }
}
