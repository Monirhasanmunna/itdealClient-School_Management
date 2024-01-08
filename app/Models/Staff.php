<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'designation_id',
        'name',
        'image',
        'father_name',
        'mother_name',
        'phone',
        'religion',
        'dob',
        'blood_group',
        'gender',
        'district',
        'upazila',
        'post_office',
        'village',
        'created_at',
        'updated_at'
    ];


    public function department()
    {
        return $this->belongsTo(HrmDepartment::class, 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
