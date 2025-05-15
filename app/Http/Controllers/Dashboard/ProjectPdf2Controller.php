<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProjectPdf;
use App\Models\Project;

class ProjectPdf2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Project $project)
    {
        $projectPdf2s = $project->projectPdf2s()->get();
        return view('dashboard.project_pdf2s.index', compact('project', 'projectPdf2s'));
    }

    public function create(Project $project)
    {
        $projects = Project::all(); // Still needed if you allow changing the project in the form
        return view('dashboard.project_pdf2s.create', compact('project', 'projects'));
    }

    public function store(Request $request, Project $project)
    {

        $request['project_id']= $project;
        $validated = $request->validate([
            'file' => 'required|file'
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public/files');
        }

        $projectPdf = $project->projectPdf2s()->create($validated);

        return redirect()->route('dashboard.projects.project_pdf2s.index', $project)->with('success', 'Project PDF created successfully.');
    }

    public function show(Project $project, ProjectPdf $projectPdf)
    {
        // Ensure the project PDF belongs to the project
        if ($projectPdf->project_id !== $project->id) {
            abort(404);
        }
        return view('dashboard.project_pdf2s.show', compact('project', 'projectPdf'));
    }

    public function edit(Project $project, ProjectPdf $projectPdf)
    {
        // Ensure the project PDF belongs to the project
        if ($projectPdf->project_id !== $project->id) {
            abort(404);
        }
        $projects = Project::all(); // For project selection in the form
        return view('dashboard.project_pdf2s.edit', compact('project', 'projectPdf', 'projects'));
    }

    public function update(Request $request, Project $project, ProjectPdf $projectPdf)
    {
        // Ensure the project PDF belongs to the project
        if ($projectPdf->project_id !== $project->id) {
            abort(404);
        }

        $request['project_id']= $project;
        $validated = $request->validate([
            'file' => 'nullable|file'
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public/files');
            if ($projectPdf->file) {
                Storage::delete($projectPdf->file);
            }
        }

        $projectPdf->update($validated);

        return redirect()->route('dashboard.projects.project_pdf2s.index', $project)->with('success', 'Project PDF updated successfully.');
    }

    public function destroy(Project $project, ProjectPdf $projectPdf)
    {
        // Ensure the project PDF belongs to the project
        if ($projectPdf->project_id !== $project->id) {
            abort(404);
        }

        $projectPdf->delete();
        return redirect()->route('dashboard.projects.project_pdf2s.index', $project)->with('success', 'Project PDF deleted successfully.');
    }

    public function restore(Project $project, $projectPdfId)
    {
        $projectPdf = ProjectPdf::withTrashed()->findOrFail($projectPdfId);
        // Ensure the project PDF belongs to the project
        if ($projectPdf->project_id !== $project->id) {
            abort(404);
        }

        $projectPdf->restore();
        return redirect()->route('dashboard.projects.project_pdf2s.index', $project)->with('success', 'Project PDF restored successfully.');
    }
}
