<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Service;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $services = \App\Models\Service::all();
        return view('dashboard.services.index', compact('services'));
    }

    public function create()
    {

        return view('dashboard.services.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|max:255',
            'img' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
        }

        $service = \App\Models\Service::create($validated);

        return redirect()->route('dashboard.services.index')->with('success', 'Service created successfully.');
    }

    public function show($id)
    {
        $service = \App\Models\Service::findOrFail($id);

        return view('dashboard.services.show', compact('service'));
    }

    public function edit($id)
    {
        $service = \App\Models\Service::findOrFail($id);

        return view('dashboard.services.edit', compact('service',));
    }

    public function update(Request $request, $id)
    {
        $service = \App\Models\Service::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|max:255',
            'img' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
            if ($service->img) Storage::delete($service->img);
        }

        $service->update($validated);

        return redirect()->route('dashboard.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = \App\Models\Service::findOrFail($id);
        $service->delete();
        return redirect()->route('dashboard.services.index')->with('success', 'Service deleted successfully.');
    }
    public function restore($id)
    {
        $service = \App\Models\Service::withTrashed()->findOrFail($id);
        $service->restore();
        return redirect()->route('dashboard.services.index')->with('success', 'Service restored successfully.');
    }
}
