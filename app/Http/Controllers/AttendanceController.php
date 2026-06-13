<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\ClassUser;
use App\Models\Classes;
use App\Models\Subject;
class AttendanceController extends Controller
{
// show class use id of auth to find class
public function nameclass(int $id)
{
    $classIds = ClassUser::where('user_id', $id)
                ->pluck('class_id');

    $classes = Classes::whereIn('id', $classIds)->get();

    return view('attendance.viewclass', compact('classes'));
}

//show use id of class to show student join
public function index(int $id)
{
    $classUser = ClassUser::where('class_id', $id)->firstOrFail();

    $classname = Classes::findOrFail($id);

    $userIds = ClassUser::where('class_id', $id)
                ->pluck('user_id');

    $users = User::whereIn('id', $userIds)->get();

    return view('attendance.attteacher', compact(
        'users',
        'classname'
    ));
}

// const { ClassUser, Classes } = require('../models');

// const nameclass = async (req, res) => {
//     try {
//         const id = req.params.id;

//         // Get class IDs for the user
//         const classUsers = await ClassUser.findAll({
//             where: { user_id: id },
//             attributes: ['class_id']
//         });

//         const classIds = classUsers.map(item => item.class_id);

//         // Get classes
//         const classes = await Classes.findAll({
//             where: {
//                 id: classIds
//             }
//         });

//         // Render view
//         res.render('attendance/viewclass', { classes });

//     } catch (error) {
//         console.error(error);
//         res.status(500).send('Server Error');
//     }
// };

// module.exports = {
//     nameclass
// };
public function store(Request $request)
{
   $request->validate([
        'user_id'  => 'required|integer',
        'class_id' => 'required|integer',
        'date'     => 'required|date',
        'subject'  => 'required|string|max:255',
        'status'   => 'required|in:present,absent,late',
    ]);

    Attendance::create([
        'user_id'  => $request->user_id,
        'class_id' => $request->class_id,
        'date'     => $request->date,
        'subject'  => $request->subject,
        'status'   => $request->status,
    ]);
   

    return back()->with('success', 'Attendance recorded successfully');
}
// get class name for attendance student
 
public function index_student(int $id)
{
   $userIds = ClassUser::where('class_id', $id)
    ->pluck('user_id');

$classname = Classes::find($id);

$users = User::whereIn('id', $userIds)->get();

foreach ($users as $user) {

    $user->present_count = Attendance::where('user_id', $user->id)
        ->where('class_id', $id)
        ->where('status', 'present')
        ->count();

    $user->absent_count = Attendance::where('user_id', $user->id)
        ->where('class_id', $id)
        ->where('status', 'absent')
        ->count();

    $user->late_count = Attendance::where('user_id', $user->id)
        ->where('class_id', $id)
        ->where('status', 'late')
        ->count();
}

return view('attendance.attstudent', compact('users', 'classname'));
}

public function update(int $id)
{
    $attendance = Attendance::where('user_id', $id)->get();
    return view('attendance.updateattendance', compact('attendance'));
}
public function clear(int $id){
     $attendance = Attendance::where('id', $id)->firstOrFail();
     $attendance->delete();
    return redirect()->back()->with('success', 'Attendance cleared successfully.');
}
public function updateAttendance(Request $request, int $id)
{
    $attendance = Attendance::where('id', $id)->firstOrFail();

    $request->validate([
        'status' => 'required|in:present,absent,late',
    ]);

    $attendance->status = $request->status;
    $attendance->save();

    return redirect()->back()->with('success', 'Attendance updated successfully.');

}
}