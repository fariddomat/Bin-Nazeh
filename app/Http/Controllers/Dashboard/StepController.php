<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Step;

class StepController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $steps = \App\Models\Step::all();
        return view('dashboard.steps.index', compact('steps'));
    }

    public function create()
    {
        
        return view('dashboard.steps.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255'
        ]);
        
        $step = \App\Models\Step::create($validated);
        
        return redirect()->route('dashboard.steps.index')->with('success', 'Step created successfully.');
    }

    public function show($id)
    {
        $step = \App\Models\Step::findOrFail($id);
        
        return view('dashboard.steps.show', compact('step'));
    }

    public function edit($id)
    {
        $step = \App\Models\Step::findOrFail($id);
        
        return view('dashboard.steps.edit', compact('step', ));
    }

    public function update(Request $request, $id)
    {
        $step = \App\Models\Step::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255'
        ]);
        
        $step->update($validated);
        
        return redirect()->route('dashboard.steps.index')->with('success', 'Step updated successfully.');
    }

        public function destroy($id)
    {
        $step = \App\Models\Step::findOrFail($id);
        $step->delete();
        return redirect()->route('dashboard.steps.index')->with('success', 'Step deleted successfully.');
    }
    public function restore($id)
    {
        $step = \App\Models\Step::withTrashed()->findOrFail($id);
        $step->restore();
        return redirect()->route('dashboard.steps.index')->with('success', 'Step restored successfully.');
    }
}