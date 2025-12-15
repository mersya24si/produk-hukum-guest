<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPerubahan extends Model
{
    use HasFactory;

    // Definisikan nama tabel secara eksplisit
    protected $table = 'riwayat_perubahan';

    // Definisikan Primary Key
    protected $primaryKey = 'riwayat_id';

    // Kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'dokumen_id',
        'tanggal',
        'uraian_perubahan',
        'versi',
    ];

    // Tentukan kolom mana yang berupa tipe data date
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi: Riwayat perubahan ini dimiliki oleh satu DokumenHukum.
     */
    public function dokumen()
    {
        // Sesuaikan nama Model Dokumen Hukum Anda jika berbeda (misalnya App\Models\Dokumen).
        // Parameter ketiga adalah nama PK di DokumenHukum, disesuaikan dengan migrasi.
        return $this->belongsTo(DokumenHukum::class, 'dokumen_id', 'dokumen_id');
    }

    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }
}
