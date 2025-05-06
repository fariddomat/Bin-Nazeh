<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Apartment;
use App\Models\Project;

class ApartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Project $project)
    {
        $apartments = $project->apartments()->withTrashed()->get();
        return view('dashboard.apartments.index', compact('project', 'apartments'));
    }

    public function create(Project $project)
    {
        $projects = Project::all(); // Still needed if you allow changing the project in the form
        return view('dashboard.apartments.create', compact('project', 'projects'));
    }

    public function store(Request $request, Project $project)
    {
        $request['project_id']= $project;
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'appendix' => 'sometimes|boolean',
            'code' => 'required|string|max:255',
            'room_count' => 'nullable|numeric',
            'area' => 'required|numeric',
            'about' => 'nullable|string',
            'price' => 'nullable|numeric',
            'price_bank' => 'nullable|numeric',
            'details' => 'required|string',
            'img' => 'nullable|image|max:2048',
            'virtual_location' => 'nullable|string',
            'youtube' => 'nullable|string'
        ]);

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
        }

        $apartment = $project->apartments()->create($validated);

        return redirect()->route('dashboard.projects.apartments.index', $project)->with('success', 'Apartment created successfully.');
    }

    public function show(Project $project, Apartment $apartment)
    {
        // Ensure the apartment belongs to the project
        if ($apartment->project_id !== $project->id) {
            abort(404);
        }
        return view('dashboard.apartments.show', compact('project', 'apartment'));
    }

    public function edit(Project $project, Apartment $apartment)
    {
        // Ensure the apartment belongs to the project
        if ($apartment->project_id !== $project->id) {
            abort(404);
        }
        $projects = Project::all(); // For project selection in the form
        return view('dashboard.apartments.edit', compact('project', 'apartment', 'projects'));
    }

    public function update(Request $request, Project $project, Apartment $apartment)
    {
        // Ensure the apartment belongs to the project
        if ($apartment->project_id !== $project->id) {
            abort(404);
        }

        $request['project_id']= $project;
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'appendix' => 'sometimes|boolean',
            'code' => 'required|string|max:255',
            'room_count' => 'nullable|numeric',
            'area' => 'required|numeric',
            'about' => 'nullable|string',
            'price' => 'nullable|numeric',
            'price_bank' => 'nullable|numeric',
            'details' => 'required|string',
            'img' => 'nullable|image|max:2048',
            'virtual_location' => 'nullable|string',
            'youtube' => 'nullable|string'
        ]);

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
            if ($apartment->img) {
                Storage::delete($apartment->img);
            }
        }

        $apartment->update($validated);

        return redirect()->route('dashboard.projects.apartments.index', $project)->with('success', 'Apartment updated successfully.');
    }

    public function destroy(Project $project, Apartment $apartment)
    {
        // Ensure the apartment belongs to the project
        if ($apartment->project_id !== $project->id) {
            abort(404);
        }

        $apartment->delete();
        return redirect()->route('dashboard.projects.apartments.index', $project)->with('success', 'Apartment deleted successfully.');
    }

    public function restore(Project $project, $apartmentId)
    {
        $apartment = Apartment::withTrashed()->findOrFail($apartmentId);
        // Ensure the apartment belongs to the project
        if ($apartment->project_id !== $project->id) {
            abort(404);
        }

        $apartment->restore();
        return redirect()->route('dashboard.projects.apartments.index', $project)->with('success', 'Apartment restored successfully.');
    }
}
