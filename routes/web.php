<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Classescontroller;
use App\Http\Controllers\Gradescontroller;
use App\Http\Controllers\Subjectcontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Assignmentformcontroller;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\Message;
use App\Http\Controllers\Textcontroller;
/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [Usercontroller::class, 'index_login'])->name('login');
Route::get('/register', [Usercontroller::class, 'index_register'])->name('register');
Route::post('/register', [Usercontroller::class, 'register'])->name('registers');
Route::post('/login', [Usercontroller::class, 'login'])->name('logins');




Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');
  
    Route::get('/profile/teacher', [ProfileController::class, 'index_teacher'])
        ->name('profile.teacher');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

});
Route::get('/attendance/{id}', [AttendanceController::class, 'index'])->name('attendance.index');

Route::get('/attendance/count/{id}', [AttendanceController::class, 'countAttendace'])->name('attendance.count');
/*
|--------------------------------------------------------------------------
| STUDENT ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/view-file/{id}', [AssignmentController::class, 'viewFile'])
    ->name('view.file');
Route::get('/studentdashboard', [Message::class, 'studentdashboard'])
    ->name('studentdashboard');


Route::get('/messages', [Assignmentformcontroller::class, 'index_message'])
    ->name('messages.student');

Route::get('/classes/student/{id}', [Subjectcontroller::class, 'index_information'])
    ->name('subjects.class');


Route::get('/classes/{id}', [Subjectcontroller::class, 'index_information_teacher'])
    ->name('subjects.teacher');



Route::post('/attendance/store', [AttendanceController::class, 'store'])
    ->name('attendance.store');

Route::get('/attendance/count/{id}', [AttendanceController::class, 'countAttendace'])->name('attendance.count');
Route::get('/attendance/student/{id}', [AttendanceController::class, 'index_student'])->name('attendance.student');
Route::get('/assignments/student/{id}', [Assignmentformcontroller::class, 'index_student'])->name('assignments.student');
Route::get('/assignments/form/{id}', [AssignmentController::class, 'view'])->name('assignments.formstudent');
Route::post('/assignments/student/store', [AssignmentController::class, 'store'])->name('assignments.studentstore');
/*
|--------------------------------------------------------------------------
| TEACHER ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/attendance/classes/{id}', [AttendanceController::class, 'nameclass'])
    ->name('attendance.nameofclass');

Route::get('/attendance/class/{id}', [AttendanceController::class, 'index'])
    ->name('attendance.classteacher');

Route::get('/assignments/create/{id}', [Assignmentformcontroller::class, 'index'])
    ->name('assignments.create');
Route::post('/assignments/store', [Assignmentformcontroller::class, 'createAssignment'])
    ->name('assignments.store');

Route::get('/teacher/submissions', [AssignmentController::class, 'viewstudent'])->name('submissions.view');
Route::delete('/teacher/delete/{id}' ,[AssignmentController::class ,'clear'])->name('submissions.delete');
Route::get('/profile/teacher/{name}', [ProfileController::class, 'profile_name'])->name('profile.teachername');
Route::get('/profile/student/{name}', [ProfileController::class, 'profile_student_name'])->name('profile.studentname');
Route::middleware(['roleteacher'])->group(function () {

Route::get('/teacherdashboard', function () {
        return view('teacherdashboard');
    })->name('teacherdashboard');

Route::get('/assignments/{id}', [Assignmentformcontroller::class, 'nameclass'])
    ->name('assignments.nameclass');

   

    // SUBJECTS
    Route::post('/subjects', [Subjectcontroller::class, 'create'])
        ->name('subjects.create');

    Route::get('/subjects/class/{id}', [Subjectcontroller::class, 'search'])
        ->name('subjects.search');

   
});

// Teacher routes
Route::get('/teacher/class', [Classescontroller::class, 'index'])
    ->name('firstclass');

Route::post('/inputclass', [Classescontroller::class, 'inputclass'])
    ->name('inputclass');

Route::get('/viewclass', [Classescontroller::class, 'viewclass'])
    ->name('viewclass');

Route::delete('/viewclass/delete/{id}', [PermissionController::class, 'delete'])
    ->name('deletename');

Route::post('/checkname', [PermissionController::class, 'Checkname'])
    ->name('Checkname');


// Student routes
Route::get('/class', [PermissionController::class, 'index'])
    ->name('Ruleview');
 Route::get('/student/{id}', [StudentsController::class, 'index'])
    ->name('student.class_'); 

Route::get('/student/class/{id}', [ClassesController::class, 'index_student'])
    ->name('student.class');

Route::post('/class', [PermissionController::class, 'store'])
    ->name('Permissionclass');


Route::post('/student/delete', [Message::class, 'kickfromclass'])
    ->name('class.kick');
Route::delete('/Classes/delete/{id}', [Classescontroller::class, 'delete_class'])
    ->name('delete.class');
Route::delete('/assignments/delete/{id}', [Assignmentformcontroller::class, 'clear'])
    ->name('assignments.clear');

Route::get('/attendance/update/{id}', [AttendanceController::class, 'update'])
    ->name('attendance.update');
Route::delete('/teacher/submissions/clear/{id}', [AttendanceController::class, 'clear'])
    ->name('attendance.clear');
Route::put('/attendance/update/{id}', [AttendanceController::class, 'updateAttendance'])
    ->name('attendance.edit');

Route::get('/messages/class/{id}', [Textcontroller::class, 'index'])->name('messages.class');
Route::get('/messages/class/teacher/{id}', [Textcontroller::class, 'index_teacher'])->name('messages.teacher');
Route::post('/messages/store', [Textcontroller::class, 'store'])->name('messages.store');
Route::delete('/messages/delete/{id}', [Textcontroller::class, 'destroy'])->name('messages.delete');