<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['session_year','status','created_at','updated_at'];


    public function lot_students()
    {
        return $this->hasMany(LotteryStudent::class);
    }
}
