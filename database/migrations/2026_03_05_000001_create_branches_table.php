<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->boolean('is_active')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        // Seed default branches
        $defaults = ['Jakarta', 'Cirendeu', 'Kebayoran', 'Cibubur', 'Bintaro', 'Ciracas'];
        foreach ($defaults as $i => $name) {
            DB::table('branches')->insert([
                'name' => $name,
                'is_active' => true,
                'sort_order' => $i + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
