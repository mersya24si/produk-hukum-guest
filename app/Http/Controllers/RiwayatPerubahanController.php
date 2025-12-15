<?php
namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\RiwayatPerubahan; // Asumsi Model Dokumen Hukum
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RiwayatPerubahanController extends Controller
{
    /**
     * Menampilkan daftar riwayat perubahan.
     * (Biasanya, riwayat ditampilkan per dokumen, tapi ini versi Index global)
     */
    public function index(Request $request)
    {
        // Mengambil semua riwayat dan memuat relasi dokumen
        $searchableColumns = ['dokumen_id','uraian_perubahan'];
        $riwayat = RiwayatPerubahan::with('dokumen')
            ->search($request, $searchableColumns)
            ->orderBy('tanggal', 'desc')
            ->paginate(15);

        return view('pages.riwayat_perubahan.index', compact('riwayat'));
    }

    /**
     * Menampilkan form untuk membuat riwayat perubahan baru.
     */
    public function create()
    {
        // Diperlukan daftar Dokumen Hukum agar bisa memilih ke dokumen mana riwayat ini terikat
        $dokumenList = DokumenHukum::select('dokumen_id', 'judul', 'nomor')->get();
        return view('pages.riwayat_perubahan.create', compact('dokumenList'));
    }

    /**
     * Menyimpan riwayat perubahan yang baru dibuat di database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dokumen_id'       => ['required', 'exists:dokumen_hukum,dokumen_id'],
            'tanggal'          => ['required', 'date'],
            'uraian_perubahan' => ['required', 'string'],
            'versi'            => ['nullable', 'string', 'max:50'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        RiwayatPerubahan::create($request->all());

        return redirect()->route('riwayat.index')->with('success', 'Riwayat perubahan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit riwayat perubahan tertentu.
     */
    public function edit($riwayat_id)
    {
        $riwayat     = RiwayatPerubahan::findOrFail($riwayat_id);
        $dokumenList = DokumenHukum::select('dokumen_id', 'judul', 'nomor')->get();

        return view('pages.riwayat_perubahan.edit', compact('riwayat', 'dokumenList'));
    }

    /**
     * Memperbarui riwayat perubahan tertentu di database.
     */
    public function update(Request $request, $riwayat_id)
    {
        $riwayat = RiwayatPerubahan::findOrFail($riwayat_id);

        $validator = Validator::make($request->all(), [
            'dokumen_id'       => ['required', 'exists:dokumen_hukum,dokumen_id'],
            'tanggal'          => ['required', 'date'],
            'uraian_perubahan' => ['required', 'string'],
            'versi'            => ['nullable', 'string', 'max:50'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $riwayat->update($request->all());

        return redirect()->route('riwayat.index')->with('success', 'Riwayat perubahan berhasil diperbarui.');
    }

    /**
     * Menghapus riwayat perubahan tertentu dari database.
     */
    public function destroy($riwayat_id)
    {
        $riwayat = RiwayatPerubahan::findOrFail($riwayat_id);
        $riwayat->delete();

        return redirect()->route('riwayat.index')->with('success', 'Riwayat perubahan berhasil dihapus.');
    }

    // Metode show tidak dibuat karena biasanya detail ditampilkan di halaman edit/index.
}
