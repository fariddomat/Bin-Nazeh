<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SocialMedia;

class SocialMediaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $socialMedia = \App\Models\SocialMedia::all();
        return view('dashboard.social_media.index', compact('socialMedia'));
    }

    public function create()
    {

        return view('dashboard.social_media.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'icon' => 'required|string|max:255'
        ]);

        $socialMedia = \App\Models\SocialMedia::create($validated);

        return redirect()->route('dashboard.social_media.index')->with('success', 'SocialMedia created successfully.');
    }

    public function show($id)
    {
        $socialMedia = \App\Models\SocialMedia::findOrFail($id);

        return view('dashboard.social_media.show', compact('socialMedia'));
    }

    public function edit($id)
    {
        $socialMedia = \App\Models\SocialMedia::findOrFail($id);

        return view('dashboard.social_media.edit', compact('socialMedia', ));
    }

    public function update(Request $request, $id)
    {
        $socialMedia = \App\Models\SocialMedia::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'icon' => 'required|string|max:255'
        ]);

        $socialMedia->update($validated);

        return redirect()->route('dashboard.social_media.index')->with('success', 'SocialMedia updated successfully.');
    }

        public function destroy($id)
    {
        $socialMedia = \App\Models\SocialMedia::findOrFail($id);
        $socialMedia->delete();
        return redirect()->route('dashboard.social_media.index')->with('success', 'SocialMedia deleted successfully.');
    }
    public function restore($id)
    {
        $socialMedia = \App\Models\SocialMedia::withTrashed()->findOrFail($id);
        $socialMedia->restore();
        return redirect()->route('dashboard.social_media.index')->with('success', 'SocialMedia restored successfully.');
    }
}
