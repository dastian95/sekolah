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
        Schema::table('students', function (Blueprint $table) {
            // Add graduation-related fields
            $table->decimal('nilai_akhir', 5, 2)->nullable()->after('admin_note'); // Nilai akhir siswa
            $table->text('keterangan')->nullable()->after('nilai_akhir'); // Keterangan kelulusan (misal: "Lulus dengan nilai sempurna", "Lulus dengan remedial", dll)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['nilai_akhir', 'keterangan']);
        });
    }
};
