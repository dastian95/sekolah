<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // status_keluarga was char(1) (A/C/T), change to string to store full labels
            $table->string('status_keluarga', 50)->nullable()->change();

            // kode_pos was integer, change to string to preserve leading zeros
            $table->string('kode_pos', 10)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->char('status_keluarga', 1)->nullable()->change();
            $table->integer('kode_pos')->nullable()->change();
        });
    }
};
