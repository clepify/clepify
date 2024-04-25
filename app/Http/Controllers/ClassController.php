<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\StudyProgram;

class ClassController extends Controller
{
    public function index()
    {
        // Return a view to list all classes
        return view('classes.index');
    }

    public function create()
    {
        // Mengambil semua program studi untuk pilihan dropdown
        $studyPrograms = StudyProgram::all();

        // Mengembalikan view untuk membuat kelas baru
        return view('classes.create', compact('studyPrograms'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'study_program_id' => 'required|exists:study_programs,id',
        ]);

        // Create a new class
        ClassModel::create([
            'name' => $request->name,
            'study_program_id' => $request->study_program_id,
        ]);

        // Redirect with success message
        return redirect()->route('class')->with('success', 'Class created successfully.');
    }

    public function edit(ClassModel $class)
    {
        // Mengambil semua program studi untuk pilihan dropdown
        $studyPrograms = StudyProgram::all();

        // Mengembalikan view untuk mengedit kelas
        return view('classes.edit', compact('class', 'studyPrograms'));
    }

    public function update(Request $request, ClassModel $class)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'study_program_id' => 'required|exists:study_programs,id',
        ]);

        // Update the class
        $class->update([
            'name' => $request->name,
            'study_program_id' => $request->study_program_id,
        ]);

        // Redirect with success message
        return redirect()->route('class')->with('success', 'Class updated successfully.');
    }

    public function destroy(ClassModel $class)
    {
        // Delete the class
        $class->delete();

        // Redirect with success message
        return redirect()->route('class')->with('success', 'Class deleted successfully.');
    }
}
