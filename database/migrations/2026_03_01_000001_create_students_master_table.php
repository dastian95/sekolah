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
        Schema::dropIfExists('students'); // Drop tabel lama untuk membuat yang baru

        Schema::create('students', function (Blueprint $table) {
            $table->id('id_siswa')->startingValue(1);
            
            // Data Identitas Siswa
            $table->string('nisn')->unique()->nullable(); // NISN (10 digit)
            $table->string('nis')->unique(); // NIS
            $table->string('nama'); // Nama lengkap
            $table->char('jenis_kelamin', 1)->nullable(); // L/P
            $table->string('nik')->nullable(); // Nomor Identitas Kelarga
            $table->string('warga_negara')->default('Indonesia');
            
            // Data Registrasi/Pendaftaran
            $table->string('registration_number')->unique()->nullable(); // Nomor registrasi pendaftaran
            $table->string('username')->unique();
            $table->string('password');
            $table->string('uid')->unique(); // Unique Identifier
            
            // Data Akademik
            $table->integer('kelas_awal')->nullable(); // Kelas awal saat masuk
            $table->string('tahun_masuk')->nullable(); // Tahun masuk
            $table->string('sekolah_asal')->nullable(); // Sekolah asal
            
            // Data Pribadi
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('hp')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->default('siswa.png');
            
            // Data Keluarga
            $table->integer('anak_ke')->nullable();
            $table->char('status_keluarga', 1)->nullable(); // A/C/T (Anak Kandung/Angkat/Tiri)
            $table->longText('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->integer('kode_pos')->nullable();
            
            // Data Ayah
            $table->string('nama_ayah')->nullable();
            $table->date('tgl_lahir_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nohp_ayah')->nullable();
            $table->longText('alamat_ayah')->nullable();
            
            // Data Ibu
            $table->string('nama_ibu')->nullable();
            $table->date('tgl_lahir_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('nohp_ibu')->nullable();
            $table->longText('alamat_ibu')->nullable();
            
            // Data Wali (jika ada)
            $table->string('nama_wali')->nullable();
            $table->date('tgl_lahir_wali')->nullable();
            $table->string('pendidikan_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('nohp_wali')->nullable();
            $table->longText('alamat_wali')->nullable();
            
            // Status Pendaftaran (untuk tracking pendaftaran baru/pindahan)
            $table->enum('status', ['pending', 'contacted', 'verified', 'rejected'])->default('pending');
            $table->text('admin_note')->nullable();
            
            $table->timestamps();
            
            // Index untuk optimasi query
            $table->index('nisn');
            $table->index('nis');
            $table->index('nama');
            $table->index('tahun_masuk');
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
