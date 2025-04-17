<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\About;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $abouts = \App\Models\About::all();
        return view('dashboard.abouts.index', compact('abouts'));
    }

    public function create()
    {
        
        return view('dashboard.abouts.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'discription' => 'required|string',
            'img' => 'nullable|image|max:2048',
            'icon' => 'nullable|string|max:255',
            'class' => 'nullable|string|max:255',
            'sort_id' => 'nullable|numeric'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
        }

        $about = \App\Models\About::create($validated);
        
        return redirect()->route('dashboard.abouts.index')->with('success', 'About created successfully.');
    }

    public function show($id)
    {
        $about = \App\Models\About::findOrFail($id);
        
        return view('dashboard.abouts.show', compact('about'));
    }

    public function edit($id)
    {
        $about = \App\Models\About::findOrFail($id);
        
        return view('dashboard.abouts.edit', compact('about', ));
    }

    public function update(Request $request, $id)
    {
        $about = \App\Models\About::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'discription' => 'required|string',
            'img' => 'nullable|image|max:2048',
            'icon' => 'nullable|string|max:255',
            'class' => 'nullable|string|max:255',
            'sort_id' => 'nullable|numeric'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
            if ($about->img) Storage::delete($about->img);
        }

        $about->update($validated);
        
        return redirect()->route('dashboard.abouts.index')->with('success', 'About updated successfully.');
    }

        public function destroy($id)
    {
        $about = \App\Models\About::findOrFail($id);
        $about->delete();
        return redirect()->route('dashboard.abouts.index')->with('success', 'About deleted successfully.');
    }
    public function restore($id)
    {
        $about = \App\Models\About::withTrashed()->findOrFail($id);
        $about->restore();
        return redirect()->route('dashboard.abouts.index')->with('success', 'About restored successfully.');
    }
}