<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id', 'name', 'description', 'option_1','option_2','option_3','option_4','option_5','option_6','option_7'];

    public function subject()
    {
        return $this->belongsTo(FixedSubject::class, 'subject_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
