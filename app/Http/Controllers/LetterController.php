<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLetterRequest;
use App\Models\Letter;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
  public function store(StoreLetterRequest $request)
  {
    $user = auth()->user();

    if ($user->role !== 'student') return abort(403, 'You are not authorized to perform this action');

    $letter_path = $request->file('letter_document')->store('letters', 'public');
    $letter_filename = basename($letter_path);

    $support_document = $request->file('support_document');
    $support_document_path = $support_document ? $support_document->store('supports', 'public') : null;
    $support_document_filename = null;
    if ($support_document_path) {
      $support_document_filename = basename($support_document_path);
    }

    try {
      DB::beginTransaction();

      Letter::create([
        'student_id' => $user->id,
        'date' => $request->date,
        'type' => $request->type,
        'category' => $request->category,
        'status' => 'Pending',
        'letter_document' => $letter_filename,
        'support_document' => $support_document_filename,
      ]);

      $letter = Letter::latest()->first();
      $letter->lecturer()->attach($request->input('multi-select-lecturer'));

      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->with('error', 'An error occurred while creating the letter');
    }

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

  public function approve(string $id)
  {
    $letter = Letter::findOrFail($id);
    $letter->status = 'Approved';
    $letter->save();

    return redirect()->back()->with('success', 'Letter approved successfully');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }

  public function letterTemplate()
  {
    return response()->download(public_path('documents/letter_template.docx'));
  }
}
