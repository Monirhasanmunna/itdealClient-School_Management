<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicClass extends Model
{
    use HasFactory;

    protected $guarded = ['id','group_id','section_id','name','status','created_at','updated_at'];

    
    public function groups()
    {
        return $this->hasMany(Group::class,'group_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class,'section_id');
    }
}
