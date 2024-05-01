<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\LetterStatus;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreLetterRequest;
use App\Http\Requests\UpdateLetterRequest;

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
        $letter = Letter::findOrFail($id);

        $created_at = $letter->created_at;
        $now = now();
        $diff = $now->diffInMinutes($created_at);

        if ($diff > 10 || $letter->status !== 'Pending') {
            return redirect()->back()->with('error', 'You cannot edit this letter because it has been more than 10 minutes since it was created or it has been approved or rejected');
        }

        $lecturers = Lecturer::lecturers()->get();
        $letter_lecturers = $letter->lecturer->pluck('id')->toArray();
        return view('letters.edit', compact('letter', 'lecturers', 'letter_lecturers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLetterRequest $request, string $id)
    {
        $letter = Letter::findOrFail($id);
        $created_at = $letter->created_at;
        $now = now();
        $diff = $now->diffInMinutes($created_at);

        if ($diff > 10 || $letter->status !== 'Pending') {
            return redirect()->back()->with('error', 'You cannot edit this letter because it has been more than 10 minutes since it was created or it has been approved or rejected');
        }

        $letter_filename = $letter->letter_document;
        $support_document_filename = $letter->support_document;

        if ($request->hasFile('letter_document')) {
            $letter_path = $request->file('letter_document')->store('letters', 'public');
            $letter_filename = basename($letter_path);
        }

        if ($request->hasFile('support_document')) {
            $support_document_path = $request->file('support_document')->store('supports', 'public');
            $support_document_filename = basename($support_document_path);
        }

        try {
            DB::beginTransaction();

            $letter->update([
                'date' => $request->date,
                'type' => $request->type,
                'category' => $request->category,
                'letter_document' => $letter_filename,
                'support_document' => $support_document_filename,
            ]);

            $letter->lecturer()->sync($request->input('multi-select-lecturer'));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating the letter');
        }

        return redirect()->route('letters.index')->with('success', 'Letter updated successfully');
    }

    public function approve(string $id)
    {
        $letter = Letter::findOrFail($id);
        $old_status = $letter->status;
        $letter->status = 'Approved';
        $letter->save();

        LetterStatus::create([
            'letter_id' => $letter->id,
            'user_id' => auth()->user()->id,
            'status_before' => $old_status,
            'status_after' => 'Approved',
        ]);

        return redirect()->back()->with('success', 'Letter approved successfully');
    }

    public function reject(Request $request, string $id)
    {
        $letter = Letter::findOrFail($id);
        $old_status = $letter->status;
        $letter->status = 'Rejected';

        $feedback_message = $request->input('feedback_message');
        $letter->feedback_message = $feedback_message;
        $letter->save();

        LetterStatus::create([
            'letter_id' => $letter->id,
            'user_id' => auth()->user()->id,
            'status_before' => $old_status,
            'status_after' => 'Rejected',
        ]);

        return redirect()->back()->with('success', 'Letter rejected successfully');
    }

    public function archive(string $id)
    {
        $letter = Letter::findOrFail($id);
        $old_status = $letter->status;
        $letter->status = 'Archived';
        $letter->save();

        LetterStatus::create([
            'letter_id' => $letter->id,
            'user_id' => auth()->user()->id,
            'status_before' => $old_status,
            'status_after' => 'Archived',
        ]);

        return redirect()->back()->with('success', 'Letter archived successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $letter = Letter::findOrFail($id);

        $created_at = $letter->created_at;
        $now = now();
        $diff = $now->diffInMinutes($created_at);

        if ($diff > 10) {
            return redirect()->back()->with('error', 'You cannot delete this letter because it has been more than 10 minutes since it was created');
        }

        $letter_path = 'public/letters/' . $letter->letter_document;
        $support_path = 'public/supports/' . $letter->support_document;

        if ($letter_path) {
            Storage::delete($letter_path);
        }

        if ($support_path) {
            Storage::delete($support_path);
        }

        $letter->delete();

        return redirect()->back()->with('success', 'Letter deleted successfully');
    }

    public function letterTemplate()
    {
        return response()->download(public_path('documents/letter_template.docx'));
    }
}
