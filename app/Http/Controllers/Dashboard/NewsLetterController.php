<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\NewsLetter;

class NewsLetterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $newsLetters = \App\Models\NewsLetter::all();
        return view('dashboard.news_letters.index', compact('newsLetters'));
    }

    public function create()
    {

        return view('dashboard.news_letters.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mobile' => 'required|string|max:255'
        ]);

        $newsLetter = \App\Models\NewsLetter::create($validated);

        return redirect()->route('dashboard.news_letters.index')->with('success', 'NewsLetter created successfully.');
    }

    public function show($id)
    {
        $newsLetter = \App\Models\NewsLetter::findOrFail($id);

        return view('dashboard.news_letters.show', compact('newsLetter'));
    }

    public function edit($id)
    {
        $newsLetter = \App\Models\NewsLetter::findOrFail($id);

        return view('dashboard.news_letters.edit', compact('newsLetter', ));
    }

    public function update(Request $request, $id)
    {
        $newsLetter = \App\Models\NewsLetter::findOrFail($id);
        $validated = $request->validate([
            'mobile' => 'required|string|max:255'
        ]);

        $newsLetter->update($validated);

        return redirect()->route('dashboard.news_letters.index')->with('success', 'NewsLetter updated successfully.');
    }

        public function destroy($id)
    {
        $newsLetter = \App\Models\NewsLetter::findOrFail($id);
        $newsLetter->delete();
        return redirect()->route('dashboard.news_letters.index')->with('success', 'NewsLetter deleted successfully.');
    }
    public function restore($id)
    {
        $newsLetter = \App\Models\NewsLetter::withTrashed()->findOrFail($id);
        $newsLetter->restore();
        return redirect()->route('dashboard.news_letters.index')->with('success', 'NewsLetter restored successfully.');
    }
}
