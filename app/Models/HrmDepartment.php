<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmDepartment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'created_at', 'updated_at'];


    public function designations()
    {
        return $this->hasMany(Designation::class, 'department_id');
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }
}
