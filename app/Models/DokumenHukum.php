<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
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

    public function attachments()
    {
        return $this->hasMany(Media::class, 'ref_id', 'dokumen_id')
                    ->where('ref_table', 'dokumen_hukum')
                    ->orderBy('sort_order', 'asc');
    }
}
