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
        Schema::create('juara_pacu_jalurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gelanggang_id')->constrained('gelanggangs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('tahun');
            $table->json('daftar_juara')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juara_pacu_jalurs');
    }
};
