<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class AdminBranchController extends Controller
{
    /**
     * Show branch management page.
     */
    public function index()
    {
        $branches = Branch::ordered()->get();

        return view('admin.branches.index', compact('branches'));
    }

    /**
     * Store a new branch (starts as disabled / Coming Soon).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $maxOrder = Branch::max('sort_order') ?? 0;

        Branch::create([
            'name'       => $request->name,
            'is_active'  => false, // always starts as Coming Soon
            'sort_order' => $maxOrder + 1,
        ]);

        return redirect()->route('admin.branches.index')
            ->with('success', 'Cabang "' . $request->name . '" berhasil ditambahkan dalam status Coming Soon.');
    }

    /**
     * Update branch name.
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $branch->update(['name' => $request->name]);

        return redirect()->route('admin.branches.index')
            ->with('success', 'Nama cabang berhasil diubah.');
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
