<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LampiranDokumen extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan Model ini.
     * Secara default, Laravel akan menggunakan versi plural dari nama Model (lampiran_dokumens).
     * Karena tabel Anda adalah 'lampiran_dokumen', kita perlu menentukannya secara eksplisit.
     *
     * @var string
     */
    protected $table = 'lampiran_dokumen';

    /**
     * Nama Kunci Utama (Primary Key) tabel.
     * Secara default, Laravel mengasumsikan 'id', tetapi di sini adalah 'lampiran_id'.
     *
     * @var string
     */
    protected $primaryKey = 'lampiran_id';

    /**
     * Kolom yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'dokumen_id',
        'keterangan',
        // 'created_at' dan 'updated_at' dikelola otomatis oleh $timestamps = true
    ];

    /**
     * Mendefinisikan relasi: LampiranDokumen milik satu DokumenHukum.
     *
     * @return BelongsTo
     */
    public function dokumenHukum(): BelongsTo
    {
        // Asumsi nama Model Dokumen Hukum adalah 'DokumenHukum'
        // 'dokumen_id' adalah foreign key di tabel 'lampiran_dokumen'
        // 'dokumen_id' adalah primary key di tabel 'dokumen_hukum'
        return $this->belongsTo(DokumenHukum::class, 'dokumen_id', 'dokumen_id');
    }

    public function attachments()
    {
        return $this->hasMany(Media::class, 'ref_id', 'lampiran_id')
            ->where('ref_table', 'lampiran_dokumen')
            ->orderBy('sort_order', 'asc');
    }
}
