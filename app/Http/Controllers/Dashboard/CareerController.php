<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Career;

class CareerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $careers = \App\Models\Career::all();
        return view('dashboard.careers.index', compact('careers'));
    }

    public function export()
    {
        // Set headers for CSV download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="careers.csv"',
        ];

        // Fetch data
        $careers = Career::select('id', 'name', 'email', 'phone', 'block_number', 'city', 'project_id', 'wish', 'other_wish', 'notes', 'created_at', 'updated_at')->get();

        // Create a stream output
        $output = fopen('php://output', 'w');

        // Add CSV headers
        fputcsv($output, [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Block Number',
            'City',
            'Project ID',
            'Wish',
            'Other Wish',
            'Notes',
            'Created At',
        ]);

        // Add data rows
        foreach ($careers as $career) {
            fputcsv($output, [
                $career->id,
                $career->name,
                $career->email,
                $career->phone,
                $career->block_number ?? '',
                $career->city,
                $career->project_id,
                $career->wish,
                $career->other_wish ?? '',
                $career->notes ?? '',
                $career->created_at,
            ]);
        }

        // Close the stream
        fclose($output);

        // Return response as a stream
        return response()->stream(
            function () use ($output) {
                // Stream already handled in the output buffer
            },
            200,
            $headers
        );
    }

    public function create()
    {
                $projects = \App\Models\Project::all();

        return view('dashboard.careers.create', compact([],'projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'block_number' => 'nullable|numeric',
            'city' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'wish' => 'required|in:استثمار,سكن,اخرى',
            'other_wish' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $career = \App\Models\Career::create($validated);

        return redirect()->route('dashboard.careers.index')->with('success', 'Career created successfully.');
    }

    public function show($id)
    {
        $career = \App\Models\Career::findOrFail($id);
                $projects = \App\Models\Project::all();

        return view('dashboard.careers.show', compact('career'));
    }

    public function edit($id)
    {
        $career = \App\Models\Career::findOrFail($id);
                $projects = \App\Models\Project::all();

        return view('dashboard.careers.edit', compact('career', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $career = \App\Models\Career::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'block_number' => 'nullable|numeric',
            'city' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
            'wish' => 'required|in:استثمار,سكن,اخرى',
            'other_wish' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $career->update($validated);

        return redirect()->route('dashboard.careers.index')->with('success', 'Career updated successfully.');
    }

        public function destroy($id)
    {
        $career = \App\Models\Career::findOrFail($id);
        $career->delete();
        return redirect()->route('dashboard.careers.index')->with('success', 'Career deleted successfully.');
    }
    public function restore($id)
    {
        $career = \App\Models\Career::withTrashed()->findOrFail($id);
        $career->restore();
        return redirect()->route('dashboard.careers.index')->with('success', 'Career restored successfully.');
    }
}
