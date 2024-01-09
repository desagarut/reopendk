<?php

namespace App\Http\Controllers\Informasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\PotensiRequest;
use App\Models\Potensi;
use App\Models\TipePotensi;

class PotensiController extends Controller
{
    public function index()
    {
        $page_title       = 'Potensi';
        $page_description = 'Daftar Potensi';
        $potensis         = Potensi::latest()->paginate(10);

        return view('informasi.potensi.index', compact('page_title', 'page_description', 'potensis'));
    }

    public function kategori()
    {
        $page_title       = 'Potensi';

        if ($_GET['id'] != null) {
            $potensis = Potensi::where('kategori_id', $_GET['id'])->latest()->paginate(10);
            $kategori = TipePotensi::findOrFail($_GET['id'])->nama_kategori;
        } else {
            $potensis = Potensi::latest()->paginate(10);
            $kategori = 'Semua';
        }

        $page_description = 'Kategori Potensi : ' . $kategori;

        return view('informasi.potensi.index', compact('page_title', 'page_description', 'potensis'));
    }

    public function create()
    {
        $page_title = 'Potensi';
        $page_description = 'Tambah Potensi';

        return view('informasi.potensi.create', compact('page_title', 'page_description'));
    }

    public function store(PotensiRequest $request)
    {
        try {
            $input = $request->input();

            if ($request->hasFile('file_gambar')) {
                $lampiran = $request->file('file_gambar');
                $fileName = $lampiran->getClientOriginalName();
                $path     = "storage/potensi_kecamatan/";
                $lampiran->move($path, $fileName);
                $input['file_gambar'] = $path . $fileName;
            }

            Potensi::create($input);
        } catch (\Exception $e) {
            report($e);
            return back()->withInput()->with('error', 'Simpan Potensi gagal!');
        }

        return redirect()->route('informasi.potensi.index')->with('success', 'Potensi berhasil disimpan!');
    }

    public function show(Potensi $potensi)
    {
        $page_title       = 'Potensi';
        $page_description = 'Detail Potensi';

        return view('informasi.potensi.show', compact('page_title', 'page_description', 'potensi'));
    }

    public function edit(Potensi $potensi)
    {
        $page_title       = 'Potensi';
        $page_description = 'Ubah Potensi';

        return view('informasi.potensi.edit', compact('page_title', 'page_description', 'potensi'));
    }

    public function update(PotensiRequest $request, Potensi $potensi)
    {
        try {
            $input = $request->all();

            if ($request->hasFile('file_gambar')) {
                $lampiran = $request->file('file_gambar');
                $fileName = $lampiran->getClientOriginalName();
                $path     = "storage/potensi_kecamatan/";
                $lampiran->move($path, $fileName);

                if ($potensi->file_gambar && file_exists(base_path('public/' . $potensi->file_gambar))) {
                    unlink(base_path('public/' . $potensi->file_gambar));
                }

                $input['file_gambar'] = $path . $fileName;
            }

            $potensi->update($input);
        } catch (\Exception $e) {
            report($e);
            return back()->with('error', 'Data Potensi gagal disimpan!');
        }

        return redirect()->route('informasi.potensi.index')->with('success', 'Data Potensi berhasil disimpan!');
    }

    public function destroy(Potensi $potensi)
    {
        try {
            if ($potensi->delete()) {
                unlink(base_path('public/' . $potensi->file_gambar));
            }
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('informasi.form-dokumen.index')->with('error', 'Potensi gagal dihapus!');
        }

        return redirect()->route('informasi.potensi.index')->with('success', 'Potensi Berhasil dihapus!');
    }
}
