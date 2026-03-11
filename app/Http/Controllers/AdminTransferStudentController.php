<?php

namespace App\Http\Controllers;

use App\Models\TransferStudent;
use Illuminate\Http\Request;

class AdminTransferStudentController extends Controller
{
    public function index(Request $request)
    {
        $query = TransferStudent::query();

        // Filter Search (Nama atau No Registrasi)
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('transfer_number', 'like', '%' . $request->search . '%');
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transferStudents = $query->latest()->paginate(10)->withQueryString();

        return view('admin.transfer-students.index', compact('transferStudents'));
    }

    public function show(TransferStudent $transferStudent)
    {
        return view('admin.transfer-students.show', compact('transferStudent'));
    }

    public function updateStatus(Request $request, TransferStudent $transferStudent)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,verified,rejected',
            'admin_note' => 'nullable|string',
        ]);

        $transferStudent->update($validated);

        return back()->with('success', 'Status siswa pindahan berhasil diperbarui.');
    }
}
