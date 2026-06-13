<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignmentstudent extends Model
{
    use HasFactory;
      protected $table = 'assignment_submitted_student';
    
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
