<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignmentstudent1 extends Model
{
    use HasFactory;
       protected $table = 'assignment_submitted_student1';
    
 protected $fillable = [
        'assignment_id',
        'user_id',
        'answer',        
        'file',
        'marks',
        'feedback',
        'status',
        'submitted_at',
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class);

    }
}
