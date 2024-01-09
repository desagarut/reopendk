<?php

namespace App\Http\Controllers\Informasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArtikelRequest;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ArtikelController extends Controller
{
    public function index()
    {
        $page_title       = 'Artikel';
        $page_description = 'Daftar Artikel';

        return view('informasi.artikel.index', compact('page_title', 'page_description'));
    }

    public function getDataArtikel(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Artikel::all())
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $data['show_web'] = route('berita.detail', $row->slug);

                    if (!auth()->guest()) {
                        $data['edit_url']   = route('informasi.artikel.edit', $row->id);
                        $data['delete_url'] = route('informasi.artikel.destroy', $row->id);
                    }

                    return view('forms.aksi', $data);
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '<span class="label label-danger">Tidak Aktif</span>';
                    } else {
                        return '<span class="label label-success">Aktif</span>';
                    }
                })
                ->editColumn('dibuat', function ($row) {
                    return format_datetime($row->created_at);
                })
                ->editColumn('gambar', function ($row) {
                    return '<img src="' .  asset($row->gambar) . '" style="max-width:100px; max-height:60px;"/>';
                })

                ->rawColumns(['status'])
                ->escapeColumns([])
                ->make(true);
        }
    }

    public function create()
    {
        $page_title       = 'Artikel';
        $page_description = 'Tambah Artikel';

        return view('informasi.artikel.create', compact('page_title', 'page_description'));
    }

    public function store(ArtikelRequest $request)
    {
        try {
            $input = $request->input();

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $fileName = $file->getClientOriginalName();
                $path     = "storage/artikel/";
                $file->move($path, $fileName);
                $input['gambar'] = $fileName;
            }

            Artikel::create($input);
        } catch (\Exception $e) {
            report($e);
            return back()->withInput()->with('error', 'Simpan Artikel gagal!');
        }

        return redirect()->route('informasi.artikel.index')->with('success', 'Artikel berhasil disimpan!');
    }

    //   public function edit(Artikel $artikel)
    public function edit($id)
    {
        $artikel          = Artikel::findOrFail($id);
        $page_title       = 'Artikel';
        $page_description = 'Ubah Artikel';

        return view('informasi.artikel.edit', compact('artikel', 'page_title', 'page_description', 'artikel'));
    }

    public function update(ArtikelRequest $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        try {
            $input = $request->all();

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $fileName = $file->getClientOriginalName();
                $path     = "storage/artikel/";
                $file->move($path, $fileName);

                if ($artikel->gambar && file_exists(base_path('public/' . $artikel->gambar))) {
                    unlink(base_path('public/' . $artikel->gambar));
                }

                $input['gambar'] = $fileName;
            }

            $artikel->update($input);
        } catch (\Exception $e) {
            report($e);
            return back()->withInput()->with('error', 'Artikel gagal diubah!');
        }

        return redirect()->route('informasi.artikel.index')->with('success', 'Artikel berhasil diubah!');
    }

    public function destroy($id)
    {
        try {
            $artikel = Artikel::findOrFail($id);
            if ($artikel->delete()) {
                unlink(base_path('public/' . $artikel->gambar));
            }
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('informasi.artikel.index')->with('error', 'Artikel gagal dihapus!');
        }

        return redirect()->route('informasi.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
