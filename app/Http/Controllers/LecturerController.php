<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function index()
    {
        return view('lecturers.index');
    }

    public function create()
    {
        return view('lecturers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:18',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:255',
            'gender' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
            'role' => 'lecturer',
        ]);

        return redirect()->route('lecturers')->with('success', 'Lecturer created successfully.');
    }

    public function edit(User $lecturer)
    {
        return view('lecturers.edit', compact('lecturer'));
    }

    public function update(Request $request, User $lecturer)
    {

        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:18',
            'email' => 'required|email|max:255|unique:users,email,' . $lecturer->id,
            'phone' => 'required|string|max:255',
            'gender' => 'required|string',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8';
        }

        $request->validate($rules);

        $lecturer->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'password' => $request->filled('password') ? bcrypt($request->password) : $lecturer->password,
            'role' => 'lecturer',
        ]);

        return redirect()->route('lecturers')->with('success', 'Lecturer updated successfully.');
    }

    public function destroy(User $lecturer)
    {
        $lecturer->delete();

        return redirect()->route('lecturers')->with('success', 'Lecturer deleted successfully.');
    }
}
