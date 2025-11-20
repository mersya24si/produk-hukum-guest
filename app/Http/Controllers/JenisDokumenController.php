<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisDokumen;

class JenisDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['nama_jenis', 'deskripsi'];
        $data['dataJenis']  = JenisDokumen::search($request, $searchableColumns)->simplePaginate(12)
            ->onEachSide(2);
        return view('pages.jenisdokumen.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jenisdokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:100|unique:jenisdokumen,nama_jenis',
            'deskripsi'  => 'nullable|string|max:255',
        ]);

        JenisDokumen::create($validated);

        return redirect()->route('jenisdokumen.index')
                         ->with('success', 'Data Jenis Dokumen berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataJenis'] = JenisDokumen::findOrFail($id);
        return view('pages.jenisdokumen.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenis = JenisDokumen::findOrFail($id);

        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:100|unique:jenisdokumen,nama_jenis,' . $id . ',jenis_id',
            'deskripsi'  => 'nullable|string|max:255',
        ]);

        $jenis->update($validated);

        return redirect()->route('jenisdokumen.index')
                         ->with('success', 'Data Jenis Dokumen berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenis = JenisDokumen::findOrFail($id);
        $jenis->delete();

        return redirect()->route('jenisdokumen.index')
                         ->with('success', 'Data Jenis Dokumen berhasil dihapus!');
    }
}
