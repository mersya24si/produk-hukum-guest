<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{
    protected $table      = 'jenisdokumen';
    protected $primaryKey = 'jenis_id';
    protected $fillable   = [
        'nama_jenis',
        'deskripsi',
    ];
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
