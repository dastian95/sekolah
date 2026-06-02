<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\TransferStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PendaftaranPindahanController extends Controller
{
    /**
     * Show the transfer registration form.
     */
    public function create()
    {
        if (!SiteSetting::isRegistrationOpen()) {
            return view('pendaftaran-pindahan', [
                'registrationClosed' => true,
                'closedMessage' => SiteSetting::getRegistrationClosedMessage(),
            ]);
        }

        return view('pendaftaran-pindahan', ['registrationClosed' => false]);
    }

    /**
     * Store a new transfer student registration.
     */
    public function store(Request $request)
    {
        if (!SiteSetting::isRegistrationOpen()) {
            return redirect()->route('pendaftaran-pindahan')
                ->with('error', SiteSetting::getRegistrationClosedMessage());
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'previous_school' => 'required|string|max:255',
            'current_class' => 'required|string|max:50',
            'reason_transfer' => 'required|string|max:1000',
            'parent_name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'address_short' => 'nullable|string|max:255',
            'report_card_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'transfer_letter_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Transaction to handle file uploads and database record
        $transferStudent = DB::transaction(function () use ($request, $validated) {
            // Handle file uploads
            if ($request->hasFile('report_card_file')) {
                $validated['report_card_file'] = $request->file('report_card_file')->store('transfer-documents', 'public');
            }

            if ($request->hasFile('transfer_letter_file')) {
                $validated['transfer_letter_file'] = $request->file('transfer_letter_file')->store('transfer-documents', 'public');
            }

            // Generate Transfer Number: TRANS-YYYY-XXX (e.g., TRANS-2026-001)
            $year = now()->year;
            $latestTransfer = TransferStudent::whereYear('created_at', $year)->latest('id')->first();
            $nextId = $latestTransfer ? ((int) substr($latestTransfer->transfer_number, -3)) + 1 : 1;
            
            $validated['transfer_number'] = 'TRANS-' . $year . '-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            return TransferStudent::create($validated);
        });

        return redirect()->route('pendaftaran-pindahan')
            ->with('success', 'Pendaftaran pindahan berhasil! Nomor registrasi Anda adalah ' . $transferStudent->transfer_number . '. Kami akan segera menghubungi Anda melalui WhatsApp.');
    }
}
