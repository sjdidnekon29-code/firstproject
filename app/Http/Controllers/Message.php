<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassUser;
use App\Models\Attendance;
use App\Models\Assignment;
use App\Models\Assignmentstudent;
use Illuminate\Support\Facades\Auth;

class Message extends Controller
{
   public function kickfromclass(Request $request)
{
    $classId = $request->input('class_id');
    $studentIds = $request->input('student_ids');

    ClassUser::where('class_id', $classId)
        ->whereIn('user_id', $studentIds)
        ->delete();
        return redirect()->back()->with('success', 'Selected students have been removed from the class.');
}
    public function studentdashboard()
    {
        // Total courses
        $CountClass = ClassUser::where('user_id', Auth::id())->count();

        // Attendance counts ____Total = all records (present + absent)
        $totalAttendance = Attendance::where('user_id', Auth::id())->count();

        $presentAttendance = Attendance::where('user_id', Auth::id())
            ->where('status', 'present')
            ->count();

        $absentAttendance = Attendance::where('user_id', Auth::id())
            ->where('status', 'absent')
            ->count();

        $CountAttendance = $totalAttendance > 0
            ? round(($presentAttendance / $totalAttendance) * 100, 1.5)
            : 0;

        $AbsentAttendance = $totalAttendance > 0
            ? round(($absentAttendance / $totalAttendance) * 100, 1.5)
            : 0;

       


        $CountAssignment = Assignmentstudent::where('user_id', Auth::id())->count();
        return view('studentdashboard', compact(
            'CountClass',
            'CountAttendance',
            'AbsentAttendance',
            'CountAssignment'
        ));
    }


}