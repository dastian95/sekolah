<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();

        // Filter Search (Nama atau No Registrasi)
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('registration_number', 'like', '%' . $request->search . '%')
                  ->orWhere('nisn', 'like', '%' . $request->search . '%');
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $students = $query->latest()->paginate(10)->withQueryString();

        return view('admin.students.index', compact('students'));
    }

    public function updateStatus(Request $request, Student $student)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,verified,rejected',
            'admin_note' => 'nullable|string',
        ]);

        $student->update($validated);

        return back()->with('success', 'Status siswa berhasil diperbarui.');
    }
}