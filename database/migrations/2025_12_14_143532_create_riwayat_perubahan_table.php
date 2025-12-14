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
        Schema::create('riwayat_perubahan', function (Blueprint $table) {
            // Primary Key (Kunci Utama)
            $table->id('riwayat_id'); // riwayat_id (PK)

            // Foreign Key (Kunci Asing) ke tabel 'dokumen_hukum'
            // Asumsi tabel Dokumen Hukum menggunakan primary key 'dokumen_id'
            $table->unsignedBigInteger('dokumen_id');
            $table->foreign('dokumen_id')->references('dokumen_id')->on('dokumen_hukum')->onDelete('cascade');

            // Data Perubahan
            $table->date('tanggal'); // Tanggal perubahan
            $table->text('uraian_perubahan'); // Uraian detail perubahan (misalnya: Perubahan pasal 5, revisi judul)
            $table->string('versi', 50)->nullable(); // Nomor versi dokumen setelah perubahan (misalnya: 1.1, 2.0)

            // Timestamp standar Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_perubahan');
    }
};
