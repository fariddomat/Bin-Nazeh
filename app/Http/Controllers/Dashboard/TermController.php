<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Term;

class TermController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $terms = \App\Models\Term::all();
        return view('dashboard.terms.index', compact('terms'));
    }

    public function create()
    {
        
        return view('dashboard.terms.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string'
        ]);
        
        $term = \App\Models\Term::create($validated);
        
        return redirect()->route('dashboard.terms.index')->with('success', 'Term created successfully.');
    }

    public function show($id)
    {
        $term = \App\Models\Term::findOrFail($id);
        
        return view('dashboard.terms.show', compact('term'));
    }

    public function edit($id)
    {
        $term = \App\Models\Term::findOrFail($id);
        
        return view('dashboard.terms.edit', compact('term', ));
    }

    public function update(Request $request, $id)
    {
        $term = \App\Models\Term::findOrFail($id);
        $validated = $request->validate([
            'content' => 'required|string'
        ]);
        
        $term->update($validated);
        
        return redirect()->route('dashboard.terms.index')->with('success', 'Term updated successfully.');
    }

        public function destroy($id)
    {
        $term = \App\Models\Term::findOrFail($id);
        $term->delete();
        return redirect()->route('dashboard.terms.index')->with('success', 'Term deleted successfully.');
    }
    public function restore($id)
    {
        $term = \App\Models\Term::withTrashed()->findOrFail($id);
        $term->restore();
        return redirect()->route('dashboard.terms.index')->with('success', 'Term restored successfully.');
    }
}