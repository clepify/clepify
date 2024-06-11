<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StudentDetail;
use App\Models\ClassModel;
use App\Models\StudyProgram;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }

    public function create()
    {
        $classes = ClassModel::all();
        return view('students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:class,id',
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:10',
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
            'role' => 'student',
        ]);

        $student = User::where('email', $request->email)->first();

        $study_program_id = StudyProgram::find(ClassModel::find($request->class_id)->study_program_id)->id;

        StudentDetail::create([
            'user_id' => $student->id,
            'class_id' => $request->class_id,
            'study_program_id' => $study_program_id,
        ]);

        return redirect()->route('students')->with('success', 'Student created successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'batch' => 'required|mimes:xls,xlsx|max:5120'
        ]);

        try {
            Excel::import(new StudentsImport, $request->file('batch'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->back()->with('success', 'Batch file imported successfully.');
    }

    public function edit(User $student)
    {
        $classes = ClassModel::all();
        return view('students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, User $students)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:18',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|max:255',
            'gender' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        $students->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
            'role' => 'student',
        ]);

        return redirect()->route('students')->with('success', 'Student updated successfully.');
    }

    public function destroy(User $student)
    {
        $student->studentDetail->delete();
        $student->delete();

        return redirect()->route('students')->with('success', 'Student deleted successfully.');
    }
}
