<?php

namespace App\Http\Controllers;

use App\Imports\ClassesImport;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\StudyProgram;
use Maatwebsite\Excel\Facades\Excel;

class ClassController extends Controller
{
    public function index()
    {
        return view('classes.index');
    }

    public function create()
    {
        $study_programs = StudyProgram::all();

        return view('classes.create', compact('study_programs'));
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

    public function import(Request $request)
    {
        $request->validate([
            'batch' => 'required|mimes:xls,xlsx|max:5120'
        ]);

        try {
            Excel::import(new ClassesImport, $request->file('batch'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->back()->with('success', 'Batch file imported successfully.');
    }

    public function edit(ClassModel $class)
    {
        $studyPrograms = StudyProgram::all();
        return view('classes.edit', compact('class', 'studyPrograms'));
    }

    public function update(Request $request, ClassModel $class)
    {
        $request->validate([
            'level' => 'required|integer|between:1,4',
            'name' => 'required|string|max:1',
            'study_program_id' => 'required|exists:study_programs,id',
        ]);

        $class->update([
            'level' => $request->level,
            'name' => $request->name,
            'study_program_id' => $request->study_program_id,
        ]);

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
