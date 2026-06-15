<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Textstudent;
class Textcontroller extends Controller
{   
    
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'message' => 'required',
        ]);

        Textstudent::create([
            'name' => $request->name,
            'student_id' => auth()->id(),
            'class_id' => $request->class_id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully.');
    }
 public function index(int $id){
    $messages = Textstudent::where('class_id', $id)
        ->orderBy('created_at', 'asc')
        ->get();

    $class_id = $id;

    return view('text.textstudent', compact('messages','class_id'));
}

public function index_teacher(int $id){
    $messages = Textstudent::where('class_id', $id)
        ->orderBy('created_at', 'asc')
        ->get();

    $class_id = $id;

    return view('text.textteacher', compact('messages','class_id'));
}
    public function destroy(int $id){
        $userId = auth()->id();
//          $message = Textstudent::where('id', $id)->where('student_id', $userId)->firstOrFail();
//      if (is_null($message)) {
//     return back()->with('error', 'Message not found or unauthorized.');
// }
        $message = Textstudent::findOrFail($id);   
        $message->delete();
        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
}
