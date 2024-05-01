<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Letter;
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
}
