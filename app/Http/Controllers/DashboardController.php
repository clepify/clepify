<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $classes = ClassModel::all();
        $study_programs = StudyProgram::all();

        return view('dashboard.index', compact('classes', 'study_programs'));
    }

    public function profile()
    {
        return view('dashboard.profile.index');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::find(auth()->id());
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find(auth()->id());

        if (!password_verify($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully');
    }
}
