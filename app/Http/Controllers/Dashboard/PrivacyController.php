<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Privacy;

class PrivacyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $privacies = \App\Models\Privacy::all();
        return view('dashboard.privacies.index', compact('privacies'));
    }

    public function create()
    {
        
        return view('dashboard.privacies.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string'
        ]);
        
        $privacy = \App\Models\Privacy::create($validated);
        
        return redirect()->route('dashboard.privacies.index')->with('success', 'Privacy created successfully.');
    }

    public function show($id)
    {
        $privacy = \App\Models\Privacy::findOrFail($id);
        
        return view('dashboard.privacies.show', compact('privacy'));
    }

    public function edit($id)
    {
        $privacy = \App\Models\Privacy::findOrFail($id);
        
        return view('dashboard.privacies.edit', compact('privacy', ));
    }

    public function update(Request $request, $id)
    {
        $privacy = \App\Models\Privacy::findOrFail($id);
        $validated = $request->validate([
            'content' => 'required|string'
        ]);
        
        $privacy->update($validated);
        
        return redirect()->route('dashboard.privacies.index')->with('success', 'Privacy updated successfully.');
    }

        public function destroy($id)
    {
        $privacy = \App\Models\Privacy::findOrFail($id);
        $privacy->delete();
        return redirect()->route('dashboard.privacies.index')->with('success', 'Privacy deleted successfully.');
    }
    public function restore($id)
    {
        $privacy = \App\Models\Privacy::withTrashed()->findOrFail($id);
        $privacy->restore();
        return redirect()->route('dashboard.privacies.index')->with('success', 'Privacy restored successfully.');
    }
}