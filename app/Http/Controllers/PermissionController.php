<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use  App\Models\Permissionnew;
use App\Models\Classes;
use App\Models\ClassUser;
class PermissionController extends Controller
{
    //___student
     public function index(){
      $data = Permissionnew::all();
        return view('classes.classesstudent' ,compact('data'));
     }

 public function store(Request $request)
{
    $data = $request->validate([
       'name' => 'required'
    ]);

    if (!Classes::where('class_name', $data['name'])->exists()) {
        return back()->with('error', 'This name is invalid');
    }

    //    $exists = ClassUser::where('class_name', $data['name'])
    //     ->exists();

    // if ($exists) {
    //     return back()->with('error', 'Already joined');
    // }

    Permissionnew::create([
        'user_id' => Auth::id(),
        'name' => $data['name'],
    ]);

    return back()->with('success', 'Joined successfully');
}
  //__teacher
public function Checkname(Request $request)
{
    $request->validate([
        'name' => 'required|string'
    ]);

    $name = strtolower(trim($request->name));

    // find class
    $class = Classes::whereRaw('LOWER(class_name) = ?', [$name])->first();

    if (!$class) {
        return back()->with('error', 'Class not found');
    }

    // get FIRST user only
    $user = Permissionnew::whereRaw('LOWER(name) = ?', [$name])->first();

    if (!$user) {
        return back()->with('error', 'User not found for this class');
    }

    $userId = $user->user_id;

   

    // insert join
    ClassUser::create([
        'user_id' => $userId,
        'class_id' => $class->id,
    ]);

    // DELETE permission record (correct + safe)
    $deleted = Permissionnew::whereRaw('LOWER(name) = ?', [$name])
        ->where('user_id', $userId)
        ->delete();

    // DEBUG (remove later)
    // dd([
    //     'user_id' => $userId,
    //     'deleted_rows' => $deleted,
    //     'still_exists' => Permissionnew::where('user_id', $userId)->exists(),
    // ]);

    return back()->with('success', 'Joined successfully');
}


  public function delete(int $id)
{
    $item = Permissionnew::findOrFail($id);
    $item->delete();

    return back()->with('success', 'deleted successfully');
}
}