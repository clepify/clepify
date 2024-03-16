<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class LetterController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('letters.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $lecturers = Lecturer::lecturers()->get();
    return view('letters.create', compact('lecturers'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'date_sent' => ['required', 'date'],
      'duration' => ['required', 'numeric'],
      'type' => ['required', 'string'],
      'category' => ['required', 'string'],
      'lecturer' => ['required', 'array'],
      'letter_document' => ['required', 'file', 'mimes:pdf', 'max:2048'],
      'supporting_document' => ['file', 'mimes:pdf', 'max:2048'],
    ]);

    $user = auth()->user();

    if ($user->role !== 'student') return abort(403, 'You are not authorized to perform this action');

    $letter_path = $request->file('letter_document')->store('letters', 'public');
    $letter_filename = basename($letter_path);

    $supporting_document = $request->file('supporting_document');
    $supporting_document_path = $supporting_document ? $supporting_document->store('letters', 'public') : null;
    $supporting_document_filename = null;
    if ($supporting_document_path) {
      $supporting_document_filename = basename($supporting_document_path);
    }

    Letter::create([
      'student_id' => $user->id,
      'date_sent' => $request->date_sent,
      'duration' => $request->duration,
      'type' => $request->type,
      'category' => $request->category,
      'status' => 'Pending',
      'letter_document' => $letter_filename,
      'support_document' => $supporting_document_filename,
    ]);

    return redirect()->route('letters.index')->with('success', 'Letter created successfully');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
