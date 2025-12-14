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
        Schema::create('lampiran_dokumen', function (Blueprint $table) {
                                       // Primary Key (Kunci Utama)
            $table->id('lampiran_id'); // lampiran_id (PK)

            // Foreign Key (Kunci Asing) ke tabel 'dokumen_hukum'
            // Asumsi tabel Dokumen Hukum menggunakan primary key 'dokumen_id'
            $table->unsignedBigInteger('dokumen_id');
            $table->foreign('dokumen_id')->references('dokumen_id')->on('dokumen_hukum')->onDelete('cascade');
            $table->text('keterangan')->nullable();

            // Timestamp standar Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lampiran_dokumen');
    }
};
