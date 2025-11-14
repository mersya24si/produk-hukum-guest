<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{
    protected $table = 'jenisdokumen';
    protected $primaryKey = 'jenis_id';
    protected $fillable = [
        'nama_jenis',
        'deskripsi',
];
}
