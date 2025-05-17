<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $contactuses = \App\Models\ContactUs::all();
        return view('dashboard.contact_uses.index', compact('contactuses'));
    }
    public function export()
    {
        // Set headers for CSV download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contact_uses.csv"',
        ];

        // Fetch data
        $contactUses = ContactUs::all();

        // Create a stream output
        $output = fopen('php://output', 'w');

        // Add CSV headers
        fputcsv($output, ['ID', 'Name', 'Email', 'Phone', 'Message', 'Date']);

        // Add data rows
        foreach ($contactUses as $contact) {
            fputcsv($output, [
                $contact->id,
                $contact->name,
                $contact->email,
                $contact->phone,
                $contact->message,
                $contact->created_at,
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

        return view('dashboard.contact_uses.create', compact([],'projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'project_id' => 'nullable|exists:projects,id',
            'message' => 'required|string'
        ]);

        $contactUs = \App\Models\ContactUs::create($validated);

        return redirect()->route('dashboard.contact_uses.index')->with('success', 'ContactUs created successfully.');
    }

    public function show($id)
    {
        $contactUs = \App\Models\ContactUs::findOrFail($id);
                $projects = \App\Models\Project::all();

        return view('dashboard.contact_uses.show', compact('contactUs'));
    }

    public function edit($id)
    {
        $contactUs = \App\Models\ContactUs::findOrFail($id);
                $projects = \App\Models\Project::all();

        return view('dashboard.contact_uses.edit', compact('contactUs', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $contactUs = \App\Models\ContactUs::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'project_id' => 'nullable|exists:projects,id',
            'message' => 'required|string'
        ]);

        $contactUs->update($validated);

        return redirect()->route('dashboard.contact_uses.index')->with('success', 'ContactUs updated successfully.');
    }

        public function destroy($id)
    {
        $contactUs = \App\Models\ContactUs::findOrFail($id);
        $contactUs->delete();
        return redirect()->route('dashboard.contact_uses.index')->with('success', 'ContactUs deleted successfully.');
    }
    public function restore($id)
    {
        $contactUs = \App\Models\ContactUs::withTrashed()->findOrFail($id);
        $contactUs->restore();
        return redirect()->route('dashboard.contact_uses.index')->with('success', 'ContactUs restored successfully.');
    }
}
