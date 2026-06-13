<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ClassUser;
use App\Models\Classes;
class StudentsController extends Controller
{
  public function index(int $id){
     $classIds = ClassUser::where('user_id', $id)
                ->pluck('class_id');

    $classes = Classes::whereIn('id', $classIds)->get();

    return view('attendance.studentviewclass', compact('classes'));
  }

}