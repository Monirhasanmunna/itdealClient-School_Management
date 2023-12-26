<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedSubject extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'subject_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
