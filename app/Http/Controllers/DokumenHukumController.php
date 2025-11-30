<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisDokumen;
use App\Models\Kategori;
use App\Models\Media; // Tambahkan Model Media
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan Facade Storage

class DokumenHukumController extends Controller
{
    /**
     * Menampilkan semua data dokumen hukum.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['status'];
        $searchableColumns = ['judul', 'nomor', 'tanggal'];

        // Eager load 'jenis' dan 'kategori'. Attachments bisa diload nanti di show.
        $dokumen = DokumenHukum::with(['jenis', 'kategori'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(12)
            ->onEachSide(2);

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
     * Simpan dokumen baru ke database + Upload File.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'jenis_id'    => 'required|exists:jenisdokumen,jenis_id',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'nomor'       => 'required|string|max:100',
            'judul'       => 'required|string|max:255',
            'tanggal'     => 'required|date',
            'ringkasan'   => 'required|string',
            'status'      => 'required|in:diproses,ditolak,diterima',
            // Validasi File
            'files.*'     => 'nullable|mimes:jpg,jpeg,png,pdf,docx|max:10240', // Max 10MB
        ]);

        // 2. Simpan Data Dokumen (Kecualikan 'files' dari array agar tidak error mass assignment)
        $dokumen = DokumenHukum::create(\Illuminate\Support\Arr::except($validated, ['files']));

        // 3. Logic Upload File
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                // Generate nama file
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();

                // Simpan ke disk 'public' di folder 'uploads/dokumen_hukum'
                $file->storeAs('uploads/dokumen_hukum', $filename, 'public');

                // Simpan ke DB Media
                Media::create([
                    'ref_table'  => 'dokumen_hukum', // Identifier tabel
                    'ref_id'     => $dokumen->dokumen_id, // Sesuaikan dengan Primary Key tabel dokumen
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('dokumenhukum.index')->with('success', 'Dokumen dan lampiran berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu dokumen.
     */
    public function show($id)
    {
        // Load dokumen beserta relasi attachments (media)
        $dokumen = DokumenHukum::with(['jenis', 'kategori', 'attachments'])->findOrFail($id);

        return view('pages.dokumenhukum.show', compact('dokumen'));
    }

    /**
     * Form edit dokumen.
     */
    public function edit($id)
    {
        // Load dokumen beserta relasi attachments agar foto lama muncul
        $dokumen = DokumenHukum::with(['jenis', 'kategori', 'attachments'])->findOrFail($id);
        $jenis = JenisDokumen::all();
        $kategori = Kategori::all();

        return view('pages.dokumenhukum.edit', compact('dokumen', 'jenis', 'kategori'));
    }

    /**
     * Update dokumen + Tambah File Baru.
     */
    public function update(Request $request, $id)
    {
        $dokumen = DokumenHukum::findOrFail($id);

        $validated = $request->validate([
            'jenis_id'    => 'required|exists:jenisdokumen,jenis_id',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'nomor'       => 'required|string|max:100',
            'judul'       => 'required|string|max:255',
            'tanggal'     => 'required|date',
            'ringkasan'   => 'required|string',
            'status'      => 'required|in:diproses,ditolak,diterima',
            'files.*'     => 'nullable|mimes:jpg,jpeg,png,pdf,docx|max:10240',
        ]);

        // 1. Update Data Teks
        $dokumen->update(\Illuminate\Support\Arr::except($validated, ['files']));

        // 2. Logic Tambah File Baru (Append)
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();

                $file->storeAs('uploads/dokumen_hukum', $filename, 'public');

                Media::create([
                    'ref_table'  => 'dokumen_hukum',
                    'ref_id'     => $dokumen->dokumen_id,
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('dokumenhukum.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Hapus dokumen beserta file fisiknya.
     */
    public function destroy($id)
    {
        $dokumen = DokumenHukum::findOrFail($id);

        // Ambil semua media terkait dokumen ini
        $mediaItems = Media::where('ref_table', 'dokumen_hukum')
                           ->where('ref_id', $dokumen->dokumen_id)
                           ->get();

        // Loop hapus file fisik dan record media
        foreach ($mediaItems as $media) {
            Storage::disk('public')->delete('uploads/dokumen_hukum/' . $media->file_name);
            $media->delete();
        }

        // Hapus dokumen utama
        $dokumen->delete();

        return redirect()->route('dokumenhukum.index')->with('success', 'Dokumen beserta lampiran berhasil dihapus.');
    }

    /**
     * Custom Function: Hapus SATU File (Dipanggil dari tombol hapus di Edit/Show)
     */
    public function deleteMedia($id)
    {
        $media = Media::findOrFail($id);

        // Path harus sama dengan saat upload ('uploads/dokumen_hukum')
        $path = 'uploads/dokumen_hukum/' . $media->file_name;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        $media->delete();

        return back()->with('success', 'Lampiran berhasil dihapus.');
    }
}
