<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $facilities = \App\Models\Facility::all();
        return view('dashboard.facilities.index', compact('facilities'));
    }

    public function create()
    {
        
        return view('dashboard.facilities.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:255'
        ]);
        
        $facility = \App\Models\Facility::create($validated);
        
        return redirect()->route('dashboard.facilities.index')->with('success', 'Facility created successfully.');
    }

    public function show($id)
    {
        $facility = \App\Models\Facility::findOrFail($id);
        
        return view('dashboard.facilities.show', compact('facility'));
    }

    public function edit($id)
    {
        $facility = \App\Models\Facility::findOrFail($id);
        
        return view('dashboard.facilities.edit', compact('facility', ));
    }

    public function update(Request $request, $id)
    {
        $facility = \App\Models\Facility::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:255'
        ]);
        
        $facility->update($validated);
        
        return redirect()->route('dashboard.facilities.index')->with('success', 'Facility updated successfully.');
    }

        public function destroy($id)
    {
        $facility = \App\Models\Facility::findOrFail($id);
        $facility->delete();
        return redirect()->route('dashboard.facilities.index')->with('success', 'Facility deleted successfully.');
    }
    public function restore($id)
    {
        $facility = \App\Models\Facility::withTrashed()->findOrFail($id);
        $facility->restore();
        return redirect()->route('dashboard.facilities.index')->with('success', 'Facility restored successfully.');
    }
}