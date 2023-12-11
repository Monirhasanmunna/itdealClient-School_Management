<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryStudent extends Model
{
    use HasFactory;


    // protected static function boot()
    // {
    //     static::creating(function($model){
            
    //     });
    // }

    protected $fillable = [
        'session_id',
        'applicant_id',
        'name',
        'father_name',
        'mother_name',
        'phone_number',
        'religion',
        'gender',
        'created_at',
        'updated_at'
    ];

    
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
