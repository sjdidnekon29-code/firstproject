<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\ClassUser;
use App\Models\User;
class Subjectcontroller extends Controller
{
    // TEACHER (JSON API)
    public function search(int $id)
    {
        $subjects = Subject::where('class_id', $id)->get();

        return response()->json($subjects);
    }

    // STUDENT (VIEW PAGE)
public function index_information(int $id)
{
    $classIds = ClassUser::where('class_id', $id)
        ->pluck('user_id');

   

    $students = User::whereIn('id', $classIds)->get();

    return view('informationstudent', compact('students'));
}
   public function index_information_teacher(int $id)
{
    $classIds = ClassUser::where('class_id', $id)
        ->pluck('user_id');

    $class_id = $id;

    $students = User::whereIn('id', $classIds)->get();

    return view('infomationteacher', compact('students', 'class_id'));
    
    // $classUser = ClassUser::where('user_id', $id)->first();

    // if (!$classUser) {
    //     abort(404);
    // }

    // $class_id = $classUser->class_id;

    // $userIds = ClassUser::where('class_id', $class_id)
    //             ->pluck('user_id');

    // $students = User::whereIn('id', $userIds)->get();

    // return view('infomationteacher', compact('students'));
}

    // CREATE SUBJECTS (TEACHER)
    public function create(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'subjects' => 'required|array',
        ]);

        foreach ($request->subjects as $subject) {
            Subject::create([
                'class_id' => $request->class_id,
                'subject' => $subject,
            ]);
        }

        return back()->with('success', 'Subjects saved');
    }
}