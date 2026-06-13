<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
class Usercontroller extends Controller
{
        //______________________________register page___________________________
    public function index_register(){
        return view('registerpage');
    }
    public function register (Request $request){
     $user =  $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $user['password'] = bcrypt($user['password']);
        User::create($user);
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

//______________________________login page___________________________
public function index_login(){
        return view('loginpage');
    } 
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (auth()->attempt($credentials)) {

        $request->session()->regenerate();

        $isTeacher = Teacher::where(
            'email',
            auth()->user()->email
        )->exists();

        if ($isTeacher) {
            return redirect()->route('teacherdashboard')
                ->with('success', 'Teacher login successful.');
        }

        return redirect()->route('studentdashboard')
            ->with('success', 'Student login successful.');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials.',
    ])->withInput();
}

//______________________________student dashboard page___________________________
  
}
