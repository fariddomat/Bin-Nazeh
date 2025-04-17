<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Review;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $reviews = \App\Models\Review::all();
        return view('dashboard.reviews.index', compact('reviews'));
    }

    public function create()
    {
        
        return view('dashboard.reviews.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'nullable|image|max:2048'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
        }

        $review = \App\Models\Review::create($validated);
        
        return redirect()->route('dashboard.reviews.index')->with('success', 'Review created successfully.');
    }

    public function show($id)
    {
        $review = \App\Models\Review::findOrFail($id);
        
        return view('dashboard.reviews.show', compact('review'));
    }

    public function edit($id)
    {
        $review = \App\Models\Review::findOrFail($id);
        
        return view('dashboard.reviews.edit', compact('review', ));
    }

    public function update(Request $request, $id)
    {
        $review = \App\Models\Review::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'nullable|image|max:2048'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
            if ($review->img) Storage::delete($review->img);
        }

        $review->update($validated);
        
        return redirect()->route('dashboard.reviews.index')->with('success', 'Review updated successfully.');
    }

        public function destroy($id)
    {
        $review = \App\Models\Review::findOrFail($id);
        $review->delete();
        return redirect()->route('dashboard.reviews.index')->with('success', 'Review deleted successfully.');
    }
    public function restore($id)
    {
        $review = \App\Models\Review::withTrashed()->findOrFail($id);
        $review->restore();
        return redirect()->route('dashboard.reviews.index')->with('success', 'Review restored successfully.');
    }
}