<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Certificate;

class CertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $certificates = \App\Models\Certificate::all();
        return view('dashboard.certificates.index', compact('certificates'));
    }

    public function create()
    {
        
        return view('dashboard.certificates.create', compact([],));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'img' => 'required|image|max:2048'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
        }

        $certificate = \App\Models\Certificate::create($validated);
        
        return redirect()->route('dashboard.certificates.index')->with('success', 'Certificate created successfully.');
    }

    public function show($id)
    {
        $certificate = \App\Models\Certificate::findOrFail($id);
        
        return view('dashboard.certificates.show', compact('certificate'));
    }

    public function edit($id)
    {
        $certificate = \App\Models\Certificate::findOrFail($id);
        
        return view('dashboard.certificates.edit', compact('certificate', ));
    }

    public function update(Request $request, $id)
    {
        $certificate = \App\Models\Certificate::findOrFail($id);
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'img' => 'required|image|max:2048'
        ]);
                if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('public/imgs');
            if ($certificate->img) Storage::delete($certificate->img);
        }

        $certificate->update($validated);
        
        return redirect()->route('dashboard.certificates.index')->with('success', 'Certificate updated successfully.');
    }

        public function destroy($id)
    {
        $certificate = \App\Models\Certificate::findOrFail($id);
        $certificate->delete();
        return redirect()->route('dashboard.certificates.index')->with('success', 'Certificate deleted successfully.');
    }
    public function restore($id)
    {
        $certificate = \App\Models\Certificate::withTrashed()->findOrFail($id);
        $certificate->restore();
        return redirect()->route('dashboard.certificates.index')->with('success', 'Certificate restored successfully.');
    }
}