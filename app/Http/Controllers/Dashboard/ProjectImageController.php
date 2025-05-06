<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProjectImage;
use App\Models\Project;

class ProjectImageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Project $project)
    {
        $projectImages = $project->projectImages()->get();
        return view('dashboard.project_images.index', compact('project', 'projectImages'));
    }

    public function create(Project $project)
    {
        $projects = Project::all(); // Still needed if you allow changing the project in the form
        return view('dashboard.project_images.create', compact('project', 'projects'));
    }

    public function store(Request $request, Project $project)
    {

        $request['project_id']= $project;
        $validated = $request->validate([
            'img' => 'required|image|max:2048'
        ]);

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
        }

        $projectImage = $project->projectImages()->create($validated);

        return redirect()->route('dashboard.projects.project_images.index', $project)->with('success', 'Project Image created successfully.');
    }

    public function show(Project $project, ProjectImage $projectImage)
    {
        // Ensure the project image belongs to the project
        if ($projectImage->project_id !== $project->id) {
            abort(404);
        }
        return view('dashboard.project_images.show', compact('project', 'projectImage'));
    }

    public function edit(Project $project, ProjectImage $projectImage)
    {
        // Ensure the project image belongs to the project
        if ($projectImage->project_id !== $project->id) {
            abort(404);
        }
        $projects = Project::all(); // For project selection in the form
        return view('dashboard.project_images.edit', compact('project', 'projectImage', 'projects'));
    }

    public function update(Request $request, Project $project, ProjectImage $projectImage)
    {
        // Ensure the project image belongs to the project
        if ($projectImage->project_id !== $project->id) {
            abort(404);
        }

        $request['project_id']= $project;
        $validated = $request->validate([
            'img' => 'required|image|max:2048'
        ]);

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
            if ($projectImage->img) {
                Storage::delete($projectImage->img);
            }
        }

        $projectImage->update($validated);

        return redirect()->route('dashboard.projects.project_images.index', $project)->with('success', 'Project Image updated successfully.');
    }

    public function destroy(Project $project, ProjectImage $projectImage)
    {
        // Ensure the project image belongs to the project
        if ($projectImage->project_id !== $project->id) {
            abort(404);
        }

        $projectImage->delete();
        return redirect()->route('dashboard.projects.project_images.index', $project)->with('success', 'Project Image deleted successfully.');
    }

    public function restore(Project $project, $projectImageId)
    {
        $projectImage = ProjectImage::withTrashed()->findOrFail($projectImageId);
        // Ensure the project image belongs to the project
        if ($projectImage->project_id !== $project->id) {
            abort(404);
        }

        $projectImage->restore();
        return redirect()->route('dashboard.projects.project_images.index', $project)->with('success', 'Project Image restored successfully.');
    }
}
