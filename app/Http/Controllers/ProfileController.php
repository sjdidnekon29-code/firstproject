<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profiles;

class ProfileController extends Controller
{
    // OPEN + AUTO CREATE
  public function index()
{
    $user = Auth::user();

    $profile = Profiles::firstOrCreate(
        ['user_id' => $user->id],
        [
            'phone' => $user->phone,
            'age' => $user->age,
        ]
    );

    return view('profile', compact('profile'));
}

    // UPDATE PROFILE
  public function update(Request $request)
{
    $profile = Profiles::where('user_id', Auth::id())->first();

    $profile->update([
        'phone' => $request->phone,
        'age' => $request->age,
        'gender' => $request->gender,
        'address' => $request->address,
        'city' => $request->city,
        'country' => $request->country,
        'bio' => $request->bio,
    ]);

    if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/profile'), $filename);

        $profile->profile_image = 'uploads/profile/' . $filename;
        $profile->save();
    }

    return back()->with('success', 'Profile updated');
}
 
 
/////// TEACHER PROFILE
     public function index_teacher()
{
    $user = Auth::user();

    $profile = Profiles::firstOrCreate(
        ['user_id' => $user->id],
        [
            'phone' => $user->phone,
            'age' => $user->age,
        ]
    );

    return view('profileteacher', compact('profile'));
}
public function profile_name(string $name)
{
    $user = User::whereRaw('LOWER(name) = ?', [strtolower($name)])
    ->firstOrFail();

    $profile = Profiles::where('user_id', $user->id)->firstOrFail();

    return view('profile.teacher', compact('profile', 'user'));
}
public function profile_student_name(string $name)
{
    $user = User::whereRaw('LOWER(name) = ?', [strtolower($name)])
    ->firstOrFail();

    $profile = Profiles::where('user_id', $user->id)->firstOrFail();

    return view('profile.student', compact('profile', 'user'));
}


}