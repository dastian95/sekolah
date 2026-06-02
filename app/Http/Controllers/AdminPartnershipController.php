<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPartnershipController extends Controller
{
    public function index()
    {
        $partnerships = Partnership::ordered()->get();
        return view('admin.partnerships.index', compact('partnerships'));
    }

    public function create()
    {
        return view('admin.partnerships.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'nullable|mimes:pdf|max:5120',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('partnerships', 'public');
        }

        Partnership::create([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_path'   => $filePath,
            'is_active'   => $request->boolean('is_active', true),
            'sort_order'  => $validated['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.partnerships.index')
            ->with('success', 'Kemitraan berhasil ditambahkan.');
    }

    public function edit(Partnership $partnership)
    {
        return view('admin.partnerships.edit', compact('partnership'));
    }

    public function update(Request $request, Partnership $partnership)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'nullable|mimes:pdf|max:5120',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('file')) {
            if ($partnership->file_path) {
                Storage::disk('public')->delete($partnership->file_path);
            }
            $partnership->file_path = $request->file('file')->store('partnerships', 'public');
        }

        $partnership->title       = $validated['title'];
        $partnership->description = $validated['description'] ?? null;
        $partnership->is_active   = $request->boolean('is_active');
        $partnership->sort_order  = $validated['sort_order'] ?? 0;
        $partnership->save();

        return redirect()->route('admin.partnerships.index')
            ->with('success', 'Kemitraan berhasil diperbarui.');
    }

    public function destroy(Partnership $partnership)
    {
        if ($partnership->file_path) {
            Storage::disk('public')->delete($partnership->file_path);
        }
        $partnership->delete();

        return redirect()->route('admin.partnerships.index')
            ->with('success', 'Kemitraan berhasil dihapus.');
    }

    public function toggleActive(Partnership $partnership)
    {
        $partnership->update(['is_active' => !$partnership->is_active]);
        return redirect()->route('admin.partnerships.index')
            ->with('success', 'Status kemitraan berhasil diubah.');
    }
}
