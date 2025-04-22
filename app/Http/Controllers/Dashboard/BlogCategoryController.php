<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{

    public function index()
    {
        $blogCategories = \App\Models\BlogCategory::all();
        return view('dashboard.blog_categories.index', compact('blogCategories'));
    }

    public function create()
    {

        return view('dashboard.blog_categories.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'nullable|image|max:2048'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
        }

        $blogCategory = \App\Models\BlogCategory::create($validated);

        return redirect()->route('dashboard.blog_categories.index')->with('success', 'BlogCategory created successfully.');
    }

    public function show($id)
    {
        $blogCategory = \App\Models\BlogCategory::findOrFail($id);

        return view('dashboard.blog_categories.show', compact('blogCategory'));
    }

    public function edit($id)
    {
        $blogCategory = \App\Models\BlogCategory::findOrFail($id);

        return view('dashboard.blog_categories.edit', compact('blogCategory', ));
    }

    public function update(Request $request, $id)
    {
        $blogCategory = \App\Models\BlogCategory::findOrFail($id);
        $validated = $request->validate([
            'slug' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'nullable|image|max:2048'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
            if ($blogCategory->img) Storage::delete($blogCategory->img);
        }

        $blogCategory->update($validated);

        return redirect()->route('dashboard.blog_categories.index')->with('success', 'BlogCategory updated successfully.');
    }

        public function destroy($id)
    {
        $blogCategory = \App\Models\BlogCategory::findOrFail($id);
        $blogCategory->delete();
        return redirect()->route('dashboard.blog_categories.index')->with('success', 'BlogCategory deleted successfully.');
    }
    public function restore($id)
    {
        $blogCategory = \App\Models\BlogCategory::withTrashed()->findOrFail($id);
        $blogCategory->restore();
        return redirect()->route('dashboard.blog_categories.index')->with('success', 'BlogCategory restored successfully.');
    }
}
