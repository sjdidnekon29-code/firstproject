<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_name'
    ];
    public function classes()
{
    return $this->belongsToMany(Classes::class, 'class_user');
}
}
