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
        Schema::create('dokumen_hukum', function (Blueprint $table) {
            $table->id('dokumen_id');

            // Foreign Key ke tabel jenis dokumen
            $table->unsignedBigInteger('jenis_id');

            // Foreign Key ke kategori dokumen
            $table->unsignedBigInteger('kategori_id');

            $table->string('nomor')->unique();
            $table->string('judul', 255);
            $table->date('tanggal');
            $table->text('ringkasan')->nullable();
            $table->enum('status', ['Ditolak', 'Diproses', 'Diterima'])->default('Diproses');


            $table->timestamps();

            // Relasi
            $table->foreign('jenis_id')
                  ->references('jenis_id')
                  ->on('jenisdokumen')
                  ->onDelete('cascade');

            $table->foreign('kategori_id')
                  ->references('kategori_id')
                  ->on('kategori')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_hukum');
    }
};
