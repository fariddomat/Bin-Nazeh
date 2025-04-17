<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Redirect;

class RedirectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $redirects = \App\Models\Redirect::all();
        return view('dashboard.redirects.index', compact('redirects'));
    }

    public function create()
    {
        
        return view('dashboard.redirects.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'source_url' => 'required|string|max:255',
            'destination_url' => 'required|string|max:255',
            'status_code' => 'required|numeric'
        ]);
        
        $redirect = \App\Models\Redirect::create($validated);
        
        return redirect()->route('dashboard.redirects.index')->with('success', 'Redirect created successfully.');
    }

    public function show($id)
    {
        $redirect = \App\Models\Redirect::findOrFail($id);
        
        return view('dashboard.redirects.show', compact('redirect'));
    }

    public function edit($id)
    {
        $redirect = \App\Models\Redirect::findOrFail($id);
        
        return view('dashboard.redirects.edit', compact('redirect', ));
    }

    public function update(Request $request, $id)
    {
        $redirect = \App\Models\Redirect::findOrFail($id);
        $validated = $request->validate([
            'source_url' => 'required|string|max:255',
            'destination_url' => 'required|string|max:255',
            'status_code' => 'required|numeric'
        ]);
        
        $redirect->update($validated);
        
        return redirect()->route('dashboard.redirects.index')->with('success', 'Redirect updated successfully.');
    }

        public function destroy($id)
    {
        $redirect = \App\Models\Redirect::findOrFail($id);
        $redirect->delete();
        return redirect()->route('dashboard.redirects.index')->with('success', 'Redirect deleted successfully.');
    }
    public function restore($id)
    {
        $redirect = \App\Models\Redirect::withTrashed()->findOrFail($id);
        $redirect->restore();
        return redirect()->route('dashboard.redirects.index')->with('success', 'Redirect restored successfully.');
    }
}