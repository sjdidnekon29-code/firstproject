<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassUser;
use App\Models\Classes;
use App\Models\Assignment;
use App\Models\Assignmentsubmit;
use App\Models\Assignmentstudent;
use App\Models\Assignmentstudent1;
use Illuminate\Support\Facades\Auth;
class Assignmentformcontroller extends Controller
{
      public function nameclass(int $id)
{
    $classIds = ClassUser::where('user_id', $id)
                ->pluck('class_id');

    $classes = Classes::whereIn('id', $classIds)->get();

    return view('assignment.viewclass', compact('classes'));
}

public function index(int $id)
{
    $class = Classes::findOrFail($id);
    $classname = $class->class_name;
    return view('assignment.teacher', compact('class', 'classname'));
}

public function createAssignment(Request $request)
{
    $data = $request->validate([
        'class_id' => 'required|exists:classes,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'due_date' => 'required|date',
    ]);

    Assignment::create([
        'user_id' => auth()->id(),
        'class_id' => $data['class_id'],
        'title' => $data['title'],
        'description' => $data['description'],
        'due_date' => $data['due_date'],
    ]);

    return redirect()->back()->with('success', 'Assignment created successfully.');
}
//student view
// public function index_student()
// {
//     $classIds = ClassUser::where('user_id', auth()->id())
//         ->pluck('class_id');
        
    
//     $classes = Classes::whereIn('id', $classIds)->get();
//      if (!$classes->isEmpty()) {
//         return view('assignment.student', ['classname' => 'No Class Assigned', 'assignments' => collect(), 'assignmentSubmitted' => collect()]);
//     }
//     $classname =$classes->first()->class_name;

   
  
//     $assignmentSubmitted = Assignmentstudent1::where('user_id', auth()->id())->get();
//      $assignments = Assignment::whereIn('class_id', $classIds)->get();
//     return view('assignment.student', compact('classname', 'assignments' ,'assignmentSubmitted'));
// }
public function index_student()
{
    $classIds = ClassUser::where('user_id', auth()->id())
        ->pluck('class_id');

    $classes = Classes::whereIn('id', $classIds)->get();

   
    if ($classes->isEmpty()) {
        return view('assignment.student', [
            'classname' => 'No Class Assigned',
            'assignments' => collect(),
            'assignmentSubmitted' => collect()
        ]);
    }

    $classname = $classes->first()->class_name;

    $assignmentSubmitted = Assignmentstudent1::where('user_id', auth()->id())->get();

    $assignments = Assignment::whereIn('class_id', $classIds)->get();

    return view('assignment.student', compact(
        'classname',
        'assignments',
        'assignmentSubmitted'
    ));
}
 public function clear(int $id)
{
    $assignment = Assignmentstudent1::where('assignment_id', $id)->firstOrFail();
    $assignment->delete();

    return redirect()->back()->with('success', 'Assignment cleared successfully.');
}
public function index_message()
{
    $classIds = ClassUser::where('user_id', auth()->id())
        ->pluck('class_id');

    $classes = Classes::findOrFail($classIds);
    if($classes->isEmpty()){
        return view('message.student', ['classname' => 'No Class Assigned', 'assignments' => collect() , 'classes' => collect()]);
    }
    
    
     $assignments = Assignment::whereIn('class_id', $classIds)->get();
    return view('message.student', compact('assignments' , 'classes'));
}
 

//  public function testing(int $id){
//     //we need id of assignment becuase user can send mutiple assignment to teacher 
//     // we need id of user to check 

//       $AssignmentIds = Assignment::whereIn('id', $id)  ->pluck('user_id');;

//     $userId = Auth::id();
 
//     if(!Assignment::where('user_id',$userId)->exist()){
//         return '';
//     }
//     return back()->with('message','Submitted');

//  }


}
