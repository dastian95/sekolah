<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // No Pendaftaran (Akan di-generate otomatis nanti, misal: REG-2026-001)
            $table->string('registration_number')->unique()->nullable();
            
            // Data Siswa (Essential - Data Pokok)
            $table->string('full_name');
            $table->enum('gender', ['L', 'P']); // L = Laki-laki, P = Perempuan
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('origin_school')->nullable(); // Nama TK asal (Opsional)
            
            // Data Orang Tua & Kontak (Crucial - Untuk Follow up WA)
            $table->string('parent_name');
            $table->string('whatsapp_number'); // Format 628xxx
            $table->text('address_short')->nullable(); // Alamat singkat (Kelurahan/Kecamatan)
            
            // Status Pendaftaran
            // pending = Baru daftar
            // contacted = Sudah dihubungi Admin via WA
            // verified = Data valid/Diterima
            // rejected = Tidak diterima/Batal
            $table->enum('status', ['pending', 'contacted', 'verified', 'rejected'])->default('pending');
            
            // Catatan Admin (Untuk internal note)
            $table->text('admin_note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};