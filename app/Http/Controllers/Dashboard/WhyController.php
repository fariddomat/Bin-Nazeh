<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Why;

class WhyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $whies = \App\Models\Why::all();
        return view('dashboard.whies.index', compact('whies'));
    }

    public function create()
    {
        
        return view('dashboard.whies.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'value' => 'required|string'
        ]);
        
        $why = \App\Models\Why::create($validated);
        
        return redirect()->route('dashboard.whies.index')->with('success', 'Why created successfully.');
    }

    public function show($id)
    {
        $why = \App\Models\Why::findOrFail($id);
        
        return view('dashboard.whies.show', compact('why'));
    }

    public function edit($id)
    {
        $why = \App\Models\Why::findOrFail($id);
        
        return view('dashboard.whies.edit', compact('why', ));
    }

    public function update(Request $request, $id)
    {
        $why = \App\Models\Why::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'value' => 'required|string'
        ]);
        
        $why->update($validated);
        
        return redirect()->route('dashboard.whies.index')->with('success', 'Why updated successfully.');
    }

        public function destroy($id)
    {
        $why = \App\Models\Why::findOrFail($id);
        $why->delete();
        return redirect()->route('dashboard.whies.index')->with('success', 'Why deleted successfully.');
    }
    public function restore($id)
    {
        $why = \App\Models\Why::withTrashed()->findOrFail($id);
        $why->restore();
        return redirect()->route('dashboard.whies.index')->with('success', 'Why restored successfully.');
    }
}