<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisDokumen;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DokumenHukumController extends Controller
{
    /**
     * Menampilkan semua data dokumen hukum.
     */
    public function index()
    {
        $dokumen = DokumenHukum::with(['jenis', 'kategori'])->get();
        return view('pages.dokumenhukum.index', compact('dokumen'));
    }

    /**
     * Form untuk membuat dokumen baru.
     */
    public function create()
    {
        $jenis = JenisDokumen::all();
        $kategori = Kategori::all();
        return view('pages.dokumenhukum.create', compact('jenis', 'kategori'));
    }

    /**
     * Simpan dokumen baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_id'    => 'required|exists:jenisdokumen,jenis_id',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'nomor'       => 'required|string|max:100',
            'judul'       => 'required|string|max:255',
            'tanggal'     => 'required|date',
            'ringkasan'   => 'required|string',
            'status'      => 'required|in:diproses,ditolak,diterima',
        ]);

        DokumenHukum::create($request->all());

        return redirect()->route('dokumenhukum.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu dokumen.
     */
    public function show($id)
    {
    }

    /**
     * Form edit dokumen.
     */
    public function edit($id)
    {
        $dokumen = DokumenHukum::findOrFail($id);
        $jenis = JenisDokumen::all();
        $kategori = Kategori::all();

        return view('pages.dokumenhukum.edit', compact('dokumen', 'jenis', 'kategori'));
    }

    /**
     * Update dokumen.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_id'    => 'required|exists:jenisdokumen,jenis_id',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'nomor'       => 'required|string|max:100',
            'judul'       => 'required|string|max:255',
            'tanggal'     => 'required|date',
            'ringkasan'   => 'required|string',
            'status'      => 'required|in:diproses,ditolak,diterima',
        ]);

        $dokumen = DokumenHukum::findOrFail($id);
        $dokumen->update($request->all());

        return redirect()->route('dokumenhukum.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Hapus dokumen dari database.
     */
    public function destroy($id)
    {
        $dokumen = DokumenHukum::findOrFail($id);
        $dokumen->delete();

        return redirect()->route('dokumenhukum.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
