<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JenisDokumenController extends Controller
{
    public function index()
    {
        $jenis = [
            ['jenis_id' => 1, 'nama_jenis' => 'Peraturan Desa', 'deskripsi' => 'Dokumen peraturan yang berlaku di desa'],
            ['jenis_id' => 2, 'nama_jenis' => 'Keputusan Kepala Desa', 'deskripsi' => 'Surat keputusan resmi dari kepala desa'],
            ['jenis_id' => 3, 'nama_jenis' => 'Surat Edaran', 'deskripsi' => 'Surat pemberitahuan atau pengumuman yang dikeluarkan'],
        ];

        return view('jenis_dokumen', ['jenis' => $jenis]);
    }
}
