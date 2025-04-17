<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MetaTag;

class MetaTagController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $metaTags = \App\Models\MetaTag::all();
        return view('dashboard.meta_tags.index', compact('metaTags'));
    }

    public function create()
    {

        return view('dashboard.meta_tags.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_route' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'canonical_link' => 'nullable|string|max:255',
            'schema_markup' => 'nullable|string'
        ]);

        $metaTag = \App\Models\MetaTag::create($validated);

        return redirect()->route('dashboard.meta_tags.index')->with('success', 'MetaTag created successfully.');
    }

    public function show($id)
    {
        $metaTag = \App\Models\MetaTag::findOrFail($id);

        return view('dashboard.meta_tags.show', compact('metaTag'));
    }

    public function edit($id)
    {
        $metaTag = \App\Models\MetaTag::findOrFail($id);

        return view('dashboard.meta_tags.edit', compact('metaTag', ));
    }

    public function update(Request $request, $id)
    {
        $metaTag = \App\Models\MetaTag::findOrFail($id);
        $validated = $request->validate([
            'page_route' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'canonical_link' => 'nullable|string|max:255',
            'schema_markup' => 'nullable|string'
        ]);

        $metaTag->update($validated);

        return redirect()->route('dashboard.meta_tags.index')->with('success', 'MetaTag updated successfully.');
    }

        public function destroy($id)
    {
        $metaTag = \App\Models\MetaTag::findOrFail($id);
        $metaTag->delete();
        return redirect()->route('dashboard.meta_tags.index')->with('success', 'MetaTag deleted successfully.');
    }
    public function restore($id)
    {
        $metaTag = \App\Models\MetaTag::withTrashed()->findOrFail($id);
        $metaTag->restore();
        return redirect()->route('dashboard.meta_tags.index')->with('success', 'MetaTag restored successfully.');
    }
}
