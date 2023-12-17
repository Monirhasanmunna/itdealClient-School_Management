<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicClass extends Model
{
    use HasFactory;

    protected $fillable = ['id','group_id','section_id','name','code','status','created_at','updated_at'];

    
    public function groups()
    {
        return $this->belongsToMany(Group::class,'class_group','academic_class_id','group_id');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class,'class_section','academic_class_id','section_id');
    }
}
