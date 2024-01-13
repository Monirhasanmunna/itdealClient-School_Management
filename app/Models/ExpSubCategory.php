<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpSubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'note', 'status', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(ExpCategory::class, 'category_id');
    }
}
