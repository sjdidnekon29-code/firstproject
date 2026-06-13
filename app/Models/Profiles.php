<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id',
        'phone',
        'age',
        'gender',
        'address',
        'city',
        'country',
        'student_id',       
        'class',
        'subject',
        'profile_image',
        'bio',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
