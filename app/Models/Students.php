<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'class_id'];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function grades()
    {
        return $this->hasMany(Grades::class, 'student_id');
    }
}