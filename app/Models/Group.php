<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','code','status','created_at','updated_at'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subjects', 'group_id');
    }

    public function class()
    {
        return $this->belongsToMany(AcademicClass::class, 'class_group', 'group_id', 'academic_class_id');
    }
}
