<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenHukum extends Model
{
    use HasFactory;

    protected $table = 'dokumen_hukum';
    protected $primaryKey = 'dokumen_id';

    protected $fillable = [
        'jenis_id',
        'kategori_id',
        'nomor',
        'judul',
        'tanggal',
        'ringkasan',
        'status',
    ];

    /**
     * Relasi ke tabel jenisdokumen (jenis_id)
     */
    public function jenis()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_id', 'jenis_id');
    }

    /**
     * Relasi ke tabel kategori (kategori_id)
     * Kalau nama model-nya berbeda, tinggal sesuaikan.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }
}
