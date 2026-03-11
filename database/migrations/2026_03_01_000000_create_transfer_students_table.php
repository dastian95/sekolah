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
        Schema::create('transfer_students', function (Blueprint $table) {
            $table->id();
            // No Pendaftaran Pindahan
            $table->string('transfer_number')->unique()->nullable();
            
            // Data Siswa
            $table->string('full_name');
            $table->enum('gender', ['L', 'P']); // L = Laki-laki, P = Perempuan
            $table->string('birth_place');
            $table->date('birth_date');
            
            // Data Sekolah Sebelumnya
            $table->string('previous_school');
            $table->string('current_class'); // Kelas saat ini di sekolah lama
            $table->text('reason_transfer'); // Alasan pindah
            
            // Data Orang Tua & Kontak
            $table->string('parent_name');
            $table->string('whatsapp_number');
            $table->text('address_short')->nullable(); // Alamat singkat
            
            // Dokumen (File path)
            $table->string('report_card_file')->nullable(); // File rapor
            $table->string('transfer_letter_file')->nullable(); // Surat pindah
            
            // Status Pendaftaran
            // pending = Baru daftar
            // contacted = Sudah dihubungi Admin
            // verified = Data valid/Diterima
            // rejected = Tidak diterima
            $table->enum('status', ['pending', 'contacted', 'verified', 'rejected'])->default('pending');
            
            // Catatan Admin
            $table->text('admin_note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_students');
    }
};
