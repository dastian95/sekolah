<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminBranchController extends Controller
{
    public function index()
    {
        $branches = Branch::ordered()->get();
        return view('admin.branches.index', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);

        $maxOrder = Branch::max('sort_order') ?? 0;
        $slug = Str::slug($request->name);
        $baseSlug = $slug;
        $i = 1;
        while (Branch::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i++;
        }

        Branch::create([
            'name'       => $request->name,
            'slug'       => $slug,
            'color'      => '#1a3a5c',
            'is_active'  => false,
            'sort_order' => $maxOrder + 1,
        ]);

        return redirect()->route('admin.branches.index')
            ->with('success', 'Cabang "' . $request->name . '" berhasil ditambahkan.');
    }

    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'school_name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'address'     => 'nullable|string|max:500',
            'phone'       => 'nullable|string|max:30',
            'email'       => 'nullable|email|max:100',
            'color'       => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'logo'        => 'nullable|image|mimes:png,jpg,jpeg,webp|max:1024',
        ]);

        $data = $request->only(['name', 'school_name', 'description', 'address', 'phone', 'email', 'color']);

        // Re-generate slug only if name changed
        if ($branch->name !== $request->name) {
            $slug = Str::slug($request->name);
            $base = $slug;
            $i = 1;
            while (Branch::where('slug', $slug)->where('id', '!=', $branch->id)->exists()) {
                $slug = $base . '-' . $i++;
            }
            $data['slug'] = $slug;
        }

        if ($request->hasFile('logo')) {
            if ($branch->logo) {
                Storage::disk('public')->delete($branch->logo);
            }
            $data['logo'] = $request->file('logo')->store('branches', 'public');
        }

        $branch->update($data);

        return redirect()->route('admin.branches.index')
            ->with('success', 'Informasi cabang "' . $branch->name . '" berhasil diperbarui.');
    }

    /**
     * Toggle branch active/disabled status.
     */
    public function toggleStatus(Branch $branch)
    {
        $branch->update(['is_active' => !$branch->is_active]);

        $status = $branch->is_active ? 'dipublikasikan (Aktif)' : 'dinonaktifkan (Coming Soon)';

        return redirect()->route('admin.branches.index')
            ->with('success', 'Cabang "' . $branch->name . '" berhasil ' . $status . '.');
    }

    /**
     * Delete a branch.
     */
    public function destroy(Branch $branch)
    {
        $name = $branch->name;
        $branch->delete();

        return redirect()->route('admin.branches.index')
            ->with('success', 'Cabang "' . $name . '" berhasil dihapus.');
    }

    /**
     * Reorder branches.
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'order'   => 'required|array',
            'order.*' => 'integer|exists:branches,id',
        ]);

        foreach ($request->order as $position => $id) {
            Branch::where('id', $id)->update(['sort_order' => $position + 1]);
        }

        return response()->json(['success' => true]);
    }
}
