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
class AssignmentController extends Controller
{
    public function view(int $id)
    {  
        
        $assignment = Assignment::findOrFail($id);
        return view('assignment.formstudent', compact('assignment'));
    }
    public function store(Request $request)
    {

        $data = $request->validate([
            'assignment_id' => 'required',
            'answer'        => 'required|string',
            'file'          => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'marks'         => 'nullable|integer|min:0|max:100',
            'feedback'      => 'nullable|string',

        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('assignments', 'public');
        }

        Assignmentsubmit::create([
            'assignment_id' => $data['assignment_id'],
            'user_id'       => auth()->id(),
            'answer'        => $data['answer'],
            'file'          => $filePath,
            'marks'         => $data['marks'] ?? null,
            'feedback'      => $data['feedback'] ?? null,
        ]);
         Assignmentstudent::create([
            'assignment_id' => $data['assignment_id'],
            'user_id'       => auth()->id(),
            'answer'        => $data['answer'],
            'file'          => $filePath,
            'marks'         => $data['marks'] ?? null,
            'feedback'      => $data['feedback'] ?? null,
        ]);
          Assignmentstudent1::create([
            'assignment_id' => $data['assignment_id'],
            'user_id'       => auth()->id(),
            'answer'        => $data['answer'],
            'file'          => $filePath,
            'marks'         => $data['marks'] ?? null,
            'feedback'      => $data['feedback'] ?? null,
        ]);
    
     Assignment::findOrFail($request->assignment_id)->delete();
       return redirect()->route('studentdashboard')->with('success', 'Assignment submitted successfully.');

    }
 
public function viewstudent()
{ 
    $id = auth()->id();
    $classUser = ClassUser::where('user_id', $id)->pluck('class_id');
    $classId = Classes::whereIn('id', $classUser)->get();

    $data = Assignmentsubmit::all();

    return view('assignment.viewsubmit', compact('data', 'classId'));
}
public function clear(int $id){
     $submission = Assignmentsubmit::where('assignment_id' , $id)->delete();
    return back()->with('message','clear' );
}

public function viewFile(int $id)
{
    $submission = Assignmentsubmit::findOrFail($id);

    $path = storage_path('app/public/' . $submission->file);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
}
}
