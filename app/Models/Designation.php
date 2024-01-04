<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = ['id','name', 'department_id', 'status', 'description', 'created_at', 'updated_at'];

    public function department()
    {
        return $this->belongsTo(HrmDepartment::class, 'department_id');
    }

}
