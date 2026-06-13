<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\ClassUser;
use App\Models\User;
use App\Models\Permissionnew;
use App\Models\Assignment;
use App\Models\Assignmentsubmit;
use App\Models\Assignmentstudent;
use App\Models\Assignmentstudent1;
use Illuminate\Support\Facades\Auth;

class Classescontroller extends Controller
{
    // show the class but issue is subject
    // we have 2 function one for teacher and one for student
    // after we get class_name, in that period we will input data some id into table class_user 
    //delete class
public function index(){
    return view('classes.classesteacher');
}

    public function inputclass(Request $request)
{
    $data = $request->validate([
        'class_name' => 'required'
    ]);
   

    $class = Classes::create($data);

    ClassUser::create([
        'class_id' => $class->id,
        'user_id' => Auth::id(),
    ]);

    return back()->with('success', 'Attendance recorded successfully');
}
  
public function viewclass()
{
    $classIds = ClassUser::where('user_id', auth()->id())
        ->pluck('class_id');

    $classes = Classes::whereIn('id', $classIds)->get();

    $classNames = $classes->pluck('class_name')->map(fn($name) => strtolower($name));

    $data = Permissionnew::whereIn(
        \Illuminate\Support\Facades\DB::raw('LOWER(name)'),
        $classNames
    )->get();

    return view('classes.classesteacher', compact('classes', 'data'));
}
    public function index_teacher(){

    }
public function delete_class(int $id)
{
    $userIds = ClassUser::where('class_id', $id)->pluck('user_id');

    Assignmentstudent::whereIn('user_id', $userIds)->delete();
    Assignmentstudent1::whereIn('user_id', $userIds)->delete();
    Assignmentsubmit::where('user_id', $id)->delete();
    ClassUser::where('class_id', $id)->delete();
    Assignment::where('class_id', $id)->delete();
   
    Classes::where('id', $id)->delete();

    return back()->with('success', 'Class deleted successfully');
}
//__________________student________________________________ 
public function index_student(int $id)
{
    $classIds = ClassUser::where('user_id', $id)->pluck('class_id');

    $class = Classes::whereIn('id', $classIds)->get();

    return view('classes.classesstudent', compact('class'));
}

}