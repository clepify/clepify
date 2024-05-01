<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyProgram;


class StudyProgramController extends Controller
{
    public function index()
    {
        return view('study_programs.index');
    }

    public function create()
    {
        return view('study_programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        StudyProgram::create($request->all());

        return redirect()->route('study_programs.index')->with('success', 'Study program created successfully.');
    }

    public function edit(StudyProgram $studyProgram)
    {
        return view('study_programs.edit', compact('studyProgram'));
    }

    public function update(Request $request, StudyProgram $studyProgram)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $studyProgram->update($request->all());

        return redirect()->route('study_programs.index')->with('success', 'Study program updated successfully.');
    }

    public function destroy(StudyProgram $studyProgram)
    {
        try {
            $studyProgram->delete();
            return redirect()->route('study_programs.index')->with('success', 'Study program deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('study_programs.index')->with('error', 'Unable to delete study program. Please make sure there are no related records.');
        }
    }
}
