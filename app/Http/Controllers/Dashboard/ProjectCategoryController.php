<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProjectCategory;

class ProjectCategoryController extends Controller
{

    public function index()
    {
        $projectCategories = \App\Models\ProjectCategory::all();
        return view('dashboard.project_categories.index', compact('projectCategories'));
    }

    public function create()
    {

        return view('dashboard.project_categories.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'nullable|image|max:2048'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
        }

        $projectCategory = \App\Models\ProjectCategory::create($validated);

        return redirect()->route('dashboard.project_categories.index')->with('success', 'ProjectCategory created successfully.');
    }

    public function show($id)
    {
        $projectCategory = \App\Models\ProjectCategory::findOrFail($id);

        return view('dashboard.project_categories.show', compact('projectCategory'));
    }

    public function edit($id)
    {
        $projectCategory = \App\Models\ProjectCategory::findOrFail($id);

        return view('dashboard.project_categories.edit', compact('projectCategory', ));
    }

    public function update(Request $request, $id)
    {
        $projectCategory = \App\Models\ProjectCategory::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'nullable|image|max:2048'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
            if ($projectCategory->img) Storage::delete($projectCategory->img);
        }

        $projectCategory->update($validated);

        return redirect()->route('dashboard.project_categories.index')->with('success', 'ProjectCategory updated successfully.');
    }

        public function destroy($id)
    {
        $projectCategory = \App\Models\ProjectCategory::findOrFail($id);
        $projectCategory->delete();
        return redirect()->route('dashboard.project_categories.index')->with('success', 'ProjectCategory deleted successfully.');
    }
    public function restore($id)
    {
        $projectCategory = \App\Models\ProjectCategory::withTrashed()->findOrFail($id);
        $projectCategory->restore();
        return redirect()->route('dashboard.project_categories.index')->with('success', 'ProjectCategory restored successfully.');
    }
}
