<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Textstudent extends Model
{
    use HasFactory;
    protected $table = 'textstudents';
    protected $fillable = [
        'name',
        'student_id',
        'class_id',
        'message',
        'voice',
    ];
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
