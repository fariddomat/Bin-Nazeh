<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Career;

class CareerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $careers = \App\Models\Career::all();
        return view('dashboard.careers.index', compact('careers'));
    }

    public function create()
    {
                $projects = \App\Models\Project::all();

        return view('dashboard.careers.create', compact([],'projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'block_number' => 'nullable|numeric',
            'city' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'wish' => 'required|in:استثمار,سكن,اخرى',
            'other_wish' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);
        
        $career = \App\Models\Career::create($validated);
        
        return redirect()->route('dashboard.careers.index')->with('success', 'Career created successfully.');
    }

    public function show($id)
    {
        $career = \App\Models\Career::findOrFail($id);
                $projects = \App\Models\Project::all();

        return view('dashboard.careers.show', compact('career'));
    }

    public function edit($id)
    {
        $career = \App\Models\Career::findOrFail($id);
                $projects = \App\Models\Project::all();

        return view('dashboard.careers.edit', compact('career', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $career = \App\Models\Career::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'block_number' => 'nullable|numeric',
            'city' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'wish' => 'required|in:استثمار,سكن,اخرى',
            'other_wish' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);
        
        $career->update($validated);
        
        return redirect()->route('dashboard.careers.index')->with('success', 'Career updated successfully.');
    }

        public function destroy($id)
    {
        $career = \App\Models\Career::findOrFail($id);
        $career->delete();
        return redirect()->route('dashboard.careers.index')->with('success', 'Career deleted successfully.');
    }
    public function restore($id)
    {
        $career = \App\Models\Career::withTrashed()->findOrFail($id);
        $career->restore();
        return redirect()->route('dashboard.careers.index')->with('success', 'Career restored successfully.');
    }
}