<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Partner;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $partners = \App\Models\Partner::all();
        return view('dashboard.partners.index', compact('partners'));
    }

    public function create()
    {
        
        return view('dashboard.partners.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'img' => 'required|image|max:2048'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
        }

        $partner = \App\Models\Partner::create($validated);
        
        return redirect()->route('dashboard.partners.index')->with('success', 'Partner created successfully.');
    }

    public function show($id)
    {
        $partner = \App\Models\Partner::findOrFail($id);
        
        return view('dashboard.partners.show', compact('partner'));
    }

    public function edit($id)
    {
        $partner = \App\Models\Partner::findOrFail($id);
        
        return view('dashboard.partners.edit', compact('partner', ));
    }

    public function update(Request $request, $id)
    {
        $partner = \App\Models\Partner::findOrFail($id);
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'img' => 'required|image|max:2048'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
            if ($partner->img) Storage::delete($partner->img);
        }

        $partner->update($validated);
        
        return redirect()->route('dashboard.partners.index')->with('success', 'Partner updated successfully.');
    }

        public function destroy($id)
    {
        $partner = \App\Models\Partner::findOrFail($id);
        $partner->delete();
        return redirect()->route('dashboard.partners.index')->with('success', 'Partner deleted successfully.');
    }
    public function restore($id)
    {
        $partner = \App\Models\Partner::withTrashed()->findOrFail($id);
        $partner->restore();
        return redirect()->route('dashboard.partners.index')->with('success', 'Partner restored successfully.');
    }
}