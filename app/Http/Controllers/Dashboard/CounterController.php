<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Counter;

class CounterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $counters = \App\Models\Counter::all();
        return view('dashboard.counters.index', compact('counters'));
    }

    public function create()
    {
        
        return view('dashboard.counters.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'value' => 'required|string|max:255'
        ]);
        
        $counter = \App\Models\Counter::create($validated);
        
        return redirect()->route('dashboard.counters.index')->with('success', 'Counter created successfully.');
    }

    public function show($id)
    {
        $counter = \App\Models\Counter::findOrFail($id);
        
        return view('dashboard.counters.show', compact('counter'));
    }

    public function edit($id)
    {
        $counter = \App\Models\Counter::findOrFail($id);
        
        return view('dashboard.counters.edit', compact('counter', ));
    }

    public function update(Request $request, $id)
    {
        $counter = \App\Models\Counter::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'value' => 'required|string|max:255'
        ]);
        
        $counter->update($validated);
        
        return redirect()->route('dashboard.counters.index')->with('success', 'Counter updated successfully.');
    }

        public function destroy($id)
    {
        $counter = \App\Models\Counter::findOrFail($id);
        $counter->delete();
        return redirect()->route('dashboard.counters.index')->with('success', 'Counter deleted successfully.');
    }
    public function restore($id)
    {
        $counter = \App\Models\Counter::withTrashed()->findOrFail($id);
        $counter->restore();
        return redirect()->route('dashboard.counters.index')->with('success', 'Counter restored successfully.');
    }
}