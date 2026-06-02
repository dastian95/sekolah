<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::ordered()->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'issued_by'   => 'nullable|string|max:255',
            'issued_date' => 'nullable|date',
            'description' => 'nullable|string',
            'file'        => 'nullable|mimes:pdf|max:5120',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $filePath  = null;
        $thumbPath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('certificates', 'public');
        }
        if ($request->hasFile('thumbnail')) {
            $thumbPath = $request->file('thumbnail')->store('certificates/thumbs', 'public');
        }

        Certificate::create([
            'title'       => $validated['title'],
            'issued_by'   => $validated['issued_by'] ?? null,
            'issued_date' => $validated['issued_date'] ?? null,
            'description' => $validated['description'] ?? null,
            'file_path'   => $filePath,
            'thumbnail'   => $thumbPath,
            'is_active'   => $request->boolean('is_active', true),
            'sort_order'  => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate added successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'issued_by'   => 'nullable|string|max:255',
            'issued_date' => 'nullable|date',
            'description' => 'nullable|string',
            'file'        => 'nullable|mimes:pdf|max:5120',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('file')) {
            if ($certificate->file_path) {
                Storage::disk('public')->delete($certificate->file_path);
            }
            $certificate->file_path = $request->file('file')->store('certificates', 'public');
        }
        if ($request->hasFile('thumbnail')) {
            if ($certificate->thumbnail) {
                Storage::disk('public')->delete($certificate->thumbnail);
            }
            $certificate->thumbnail = $request->file('thumbnail')->store('certificates/thumbs', 'public');
        }

        $certificate->title       = $validated['title'];
        $certificate->issued_by   = $validated['issued_by'] ?? null;
        $certificate->issued_date = $validated['issued_date'] ?? null;
        $certificate->description = $validated['description'] ?? null;
        $certificate->is_active   = $request->boolean('is_active');
        $certificate->sort_order  = $validated['sort_order'] ?? 0;
        $certificate->save();

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->file_path) {
            Storage::disk('public')->delete($certificate->file_path);
        }
        if ($certificate->thumbnail) {
            Storage::disk('public')->delete($certificate->thumbnail);
        }
        $certificate->delete();

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate deleted successfully.');
    }

    public function toggleActive(Certificate $certificate)
    {
        $certificate->update(['is_active' => !$certificate->is_active]);
        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate status updated.');
    }
}
