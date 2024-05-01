<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\StudyProgram;

class ClassController extends Controller
{
    public function index()
    {
        return view('classes.index');
    }

    public function create()
    {
        $studyPrograms = StudyProgram::all();

        return view('classes.create', compact('studyPrograms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|integer|between:1,4',
            'name' => 'required|string|max:1',
            'study_program_id' => 'required|exists:study_programs,id',
        ]);

        ClassModel::create([
            'level' => $request->level,
            'name' => $request->name,
            'study_program_id' => $request->study_program_id,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
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
        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    public function destroy(ClassModel $class)
    {
        try {
            $class->delete();
            return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('classes.index')->with('error', 'Unable to delete class. Please make sure there are no related records.');
        }
    }
}
