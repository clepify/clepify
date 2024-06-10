<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::all();
        return view('templates.index', compact('templates'));
    }

    public function create()
    {
        return view('templates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
        ]);

        $document = $request->file('document');
        $document_path = $document->storeAs('templates', $document->getClientOriginalName(), 'public');

        Template::create([
            'type' => $request->type,
            'description' => $request->description,
            'document' => $document->getClientOriginalName(),
        ]);

        return redirect()->route('templates.index')->with('success', 'Template created successfully.');
    }

    public function destroy(Template $template)
    {
        try {
            $template->delete();
            return redirect()->route('templates.index')->with('success', 'Template deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('templates.index')->with('error', 'Unable to delete Template. Please make sure there are no related records.');
        }
    }
}
