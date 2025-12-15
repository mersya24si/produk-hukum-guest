<?php

namespace App\Http\Controllers;

use App\Models\LampiranDokumen; // Model utama
use App\Models\DokumenHukum; // Model relasi
use App\Models\Media; // Model Media untuk lampiran file
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Facade Storage untuk operasi file

class LampiranDokumenController extends Controller
{
    /**
     * Folder penyimpanan untuk lampiran dokumen ini.
     * Akan digunakan di Storage::disk('public')->delete/storeAs()
     *
     * @var string
     */
    protected $uploadPath = 'uploads/lampiran_dokumen';

    /**
     * Nama tabel untuk kolom 'ref_table' di tabel Media.
     *
     * @var string
     */
    protected $refTable = 'lampiran_dokumen';


    /**
     * Menampilkan daftar semua Lampiran Dokumen.
     */
    public function index(Request $request)
    {
        // Eager load relasi dokumenHukum dan attachments (Media)
        $searchableColumns = ['dokumen_id', 'keterangan'];
        $lampiran = LampiranDokumen::with(['dokumenHukum', 'attachments'])
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(12)
            ->onEachSide(2);

        // Sesuaikan nama view Anda
        return view('pages.lampirandokumen.index', compact('lampiran'));
    }

    /**
     * Menampilkan form untuk membuat Lampiran Dokumen baru.
     * Biasanya, lampiran dibuat di dalam konteks DokumenHukum.
     */
    public function create()
    {
        // Ambil data DokumenHukum untuk dropdown/relasi
        $dokumenHukum = DokumenHukum::all();
        return view('pages.lampirandokumen.create', compact('dokumenHukum'));
    }

    /**
     * Simpan Lampiran Dokumen baru ke database + Upload File.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'dokumen_id'  => 'required|exists:dokumen_hukum,dokumen_id', // Pastikan dokumen_id valid
            'keterangan'  => 'nullable|string',
            // Validasi File
            'files.*'     => 'required|mimes:jpg,jpeg,png,pdf,docx|max:10240', // File harus diisi untuk lampiran
        ]);

        // 2. Simpan Data Lampiran Dokumen (Kecualikan 'files')
        $lampiran = LampiranDokumen::create(\Illuminate\Support\Arr::except($validated, ['files']));

        // 3. Logic Upload File
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                // Generate nama file
                $filename = time() . '_' . $index . '_' . $file->getClientOriginalName();

                // Simpan ke disk 'public' di folder 'uploads/lampiran_dokumen'
                $file->storeAs($this->uploadPath, $filename, 'public');

                // Simpan ke DB Media
                Media::create([
                    'ref_table'  => $this->refTable, // 'lampiran_dokumen'
                    'ref_id'     => $lampiran->lampiran_id, // Primary Key dari LampiranDokumen
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('lampirandokumen.index')->with('success', 'Lampiran Dokumen berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu Lampiran Dokumen.
     */
    public function show($id)
    {
        // Load lampiran beserta relasi attachments (media)
        $lampiran = LampiranDokumen::with(['dokumenHukum', 'attachments'])->findOrFail($id);

        return view('pages.lampirandokumen.show', compact('lampiran'));
    }

    /**
     * Form edit Lampiran Dokumen.
     */
    public function edit($id)
    {
        $lampiran = LampiranDokumen::with(['dokumenHukum', 'attachments'])->findOrFail($id);
        $dokumenHukum = DokumenHukum::all();

        return view('pages.lampirandokumen.edit', compact('lampiran', 'dokumenHukum'));
    }

    /**
     * Update Lampiran Dokumen + Tambah File Baru (Optional).
     */
    public function update(Request $request, $id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);

        $validated = $request->validate([
            'dokumen_id'  => 'required|exists:dokumen_hukum,dokumen_id',
            'keterangan'  => 'nullable|string',
            'files.*'     => 'nullable|mimes:jpg,jpeg,png,pdf,docx|max:10240', // File opsional saat update
        ]);

        // 1. Update Data Teks
        $lampiran->update(\Illuminate\Support\Arr::except($validated, ['files']));

        // 2. Logic Tambah File Baru (Append)
        if ($request->hasFile('files')) {
            $existingMediaCount = $lampiran->attachments()->count(); // Hitung jumlah file yang sudah ada
            foreach ($request->file('files') as $index => $file) {
                $filename = time() . '_' . ($existingMediaCount + $index) . '_' . $file->getClientOriginalName();

                $file->storeAs($this->uploadPath, $filename, 'public');

                Media::create([
                    'ref_table'  => $this->refTable,
                    'ref_id'     => $lampiran->lampiran_id,
                    'file_name'  => $filename,
                    'caption'    => $file->getClientOriginalName(),
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $existingMediaCount + $index, // Lanjutkan urutan
                ]);
            }
        }

        return redirect()->route('lampirandokumen.index')->with('success', 'Lampiran Dokumen berhasil diperbarui.');
    }

    /**
     * Hapus Lampiran Dokumen beserta semua file fisiknya.
     */
    public function destroy($id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);

        // Ambil semua media terkait lampiran ini
        $mediaItems = Media::where('ref_table', $this->refTable)
                           ->where('ref_id', $lampiran->lampiran_id)
                           ->get();

        // Loop hapus file fisik dan record media
        foreach ($mediaItems as $media) {
            Storage::disk('public')->delete($this->uploadPath . '/' . $media->file_name);
            $media->delete();
        }

        // Hapus dokumen utama
        $lampiran->delete();

        return redirect()->route('lampirandokumen.index')->with('success', 'Lampiran Dokumen berhasil dihapus.');
    }

    /**
     * Custom Function: Hapus SATU File Media (Dipanggil dari tombol hapus di Edit/Show)
     */
    public function deleteMedia($id)
    {
        $media = Media::findOrFail($id);

        // Pastikan media ini memang dari tabel yang benar
        if ($media->ref_table !== $this->refTable) {
             return back()->withErrors(['error' => 'Media tidak valid untuk entitas ini.']);
        }

        // Path harus sama dengan saat upload
        $path = $this->uploadPath . '/' . $media->file_name;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        $media->delete();

        return back()->with('success', 'File lampiran berhasil dihapus.');
    }
}
