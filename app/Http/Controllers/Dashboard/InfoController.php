<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Info;

class InfoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $infos = \App\Models\Info::all();
        return view('dashboard.infos.index', compact('infos'));
    }

    public function create()
    {
        
        return view('dashboard.infos.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'location_link' => 'nullable|string',
            'email' => 'nullable|string|max:255',
            'phone_1' => 'nullable|string|max:255',
            'phone_2' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'logo_2' => 'nullable|image|max:2048'
        ]);
                if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('public/logos');
        }
        if ($request->hasFile('logo_2')) {
            $validated['logo_2'] = $request->file('logo_2')->store('public/logo_2s');
        }

        $info = \App\Models\Info::create($validated);
        
        return redirect()->route('dashboard.infos.index')->with('success', 'Info created successfully.');
    }

    public function show($id)
    {
        $info = \App\Models\Info::findOrFail($id);
        
        return view('dashboard.infos.show', compact('info'));
    }

    public function edit($id)
    {
        $info = \App\Models\Info::findOrFail($id);
        
        return view('dashboard.infos.edit', compact('info', ));
    }

    public function update(Request $request, $id)
    {
        $info = \App\Models\Info::findOrFail($id);
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'location_link' => 'nullable|string',
            'email' => 'nullable|string|max:255',
            'phone_1' => 'nullable|string|max:255',
            'phone_2' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'logo_2' => 'nullable|image|max:2048'
        ]);
                if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('public/logos');
            if ($info->logo) Storage::delete($info->logo);
        }
        if ($request->hasFile('logo_2')) {
            $validated['logo_2'] = $request->file('logo_2')->store('public/logo_2s');
            if ($info->logo_2) Storage::delete($info->logo_2);
        }

        $info->update($validated);
        
        return redirect()->route('dashboard.infos.index')->with('success', 'Info updated successfully.');
    }

        public function destroy($id)
    {
        $info = \App\Models\Info::findOrFail($id);
        $info->delete();
        return redirect()->route('dashboard.infos.index')->with('success', 'Info deleted successfully.');
    }
    public function restore($id)
    {
        $info = \App\Models\Info::withTrashed()->findOrFail($id);
        $info->restore();
        return redirect()->route('dashboard.infos.index')->with('success', 'Info restored successfully.');
    }
}