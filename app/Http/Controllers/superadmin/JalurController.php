<?php

namespace App\Http\Controllers\superadmin;

use App\Models\Jalur;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class JalurController extends Controller
{
    public function index()
    {
        $jalur = Jalur::all();
        return view('pagesuperadmin.managejalur.index', compact('jalur'));
    }

    public function create()
    {
        return view('pagesuperadmin.managejalur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jalur' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'asal_jalur' => 'required|string|max:255',
            'tahun_buat' => 'required|string|max:4',
        ]);

        try {
            $gambar = $request->file('gambar');
            $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
            
            // Pastikan folder tujuan ada
            $destinationPath = public_path('image/jalur');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            // Pindahkan file ke folder public/image/jalur
            $gambar->move($destinationPath, $gambarName);

            Jalur::create([
                'nama_jalur' => $request->nama_jalur,
                'deskripsi' => $request->deskripsi,
                'gambar' => $gambarName,
                'asal_jalur' => $request->asal_jalur,
                'tahun_buat' => $request->tahun_buat,
            ]);

            Alert::toast('Data Jalur berhasil ditambahkan', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('managejalur.index');
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat menyimpan data', 'error')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        $jalur = Jalur::findOrFail($id);
        return view('pagesuperadmin.managejalur.show', compact('jalur'));
    }

    public function edit($id)
    {
        $jalur = Jalur::findOrFail($id);
        return view('pagesuperadmin.managejalur.edit', compact('jalur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jalur' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'asal_jalur' => 'required|string|max:255',
            'tahun_buat' => 'required|string|max:4',
        ]);

        try {
            $jalur = Jalur::findOrFail($id);

            // Cek apakah user mengupload gambar baru
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($jalur->gambar && file_exists(public_path('image/jalur/' . $jalur->gambar))) {
                    unlink(public_path('image/jalur/' . $jalur->gambar));
                }

                $gambar = $request->file('gambar');
                $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
                
                // Pastikan folder tujuan ada
                $destinationPath = public_path('image/jalur');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                
                // Pindahkan file baru ke folder public/image/jalur
                $gambar->move($destinationPath, $gambarName);

                $jalur->update([
                    'nama_jalur' => $request->nama_jalur,
                    'deskripsi' => $request->deskripsi,
                    'gambar' => $gambarName,
                    'asal_jalur' => $request->asal_jalur,
                    'tahun_buat' => $request->tahun_buat,
                ]);
            } else {
                // Jika tidak ada gambar baru, update semua field kecuali gambar
                $jalur->update([
                    'nama_jalur' => $request->nama_jalur,
                    'deskripsi' => $request->deskripsi,
                    'asal_jalur' => $request->asal_jalur,
                    'tahun_buat' => $request->tahun_buat,
                ]);
            }

            Alert::toast('Data Jalur berhasil diperbarui', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('managejalur.index');
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat memperbarui data', 'error')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $jalur = Jalur::findOrFail($id);

            // Hapus file gambar dari folder public
            if ($jalur->gambar && file_exists(public_path('image/jalur/' . $jalur->gambar))) {
                unlink(public_path('image/jalur/' . $jalur->gambar));
            }

            $jalur->delete();

            Alert::toast('Data Jalur berhasil dihapus', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('managejalur.index');
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat menghapus data', 'error')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->back();
        }
    }
}