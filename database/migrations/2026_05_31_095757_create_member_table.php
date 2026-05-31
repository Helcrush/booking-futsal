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
        Schema::create('member', function (Blueprint $table) {
            $table->id();
            // Menghubungkan member ke data penyewa dasar
            $table->foreignId('penyewa_id')->constrained('penyewa')->onDelete('cascade');
            $table->string('kode_member')->unique(); // Contoh: MBB001
            $table->date('tanggal_join');
            $table->date('tanggal_kadaluarsa');
            $table->enum('status_member', ['aktif', 'non-aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member');
    }
};