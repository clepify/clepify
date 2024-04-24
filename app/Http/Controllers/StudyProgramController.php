<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudyProgramController extends Controller
{
  public function index()
  {
    return view('study_programs.index');
  }
}
