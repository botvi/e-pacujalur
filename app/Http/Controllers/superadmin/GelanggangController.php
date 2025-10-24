<?php

namespace App\Http\Controllers\superadmin;

use App\Models\Gelanggang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GelanggangController extends Controller
{
    public function index()
    {
        $gelanggang = Gelanggang::all();
        return view('pagesuperadmin.managegelanggang.index', compact('gelanggang'));
    }

    public function create()
    {
        return view('pagesuperadmin.managegelanggang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gelanggang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lokasi_gelanggang' => 'required|string|max:255',
            'maps' => 'required|string|max:255',
        ]);

        try {
            $gambar = $request->file('gambar');
            $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
            
            // Pastikan folder tujuan ada
            $destinationPath = public_path('image/gelanggang');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            // Pindahkan file ke folder public/image/gelanggang
            $gambar->move($destinationPath, $gambarName);

            Gelanggang::create([
                'nama_gelanggang' => $request->nama_gelanggang,
                'deskripsi' => $request->deskripsi,
                'gambar' => $gambarName,
                'lokasi_gelanggang' => $request->lokasi_gelanggang,
                'maps' => $request->maps,
            ]);

            Alert::toast('Data Gelanggang berhasil ditambahkan', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('managegelanggang.index');
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat menyimpan data', 'error')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        $gelanggang = Gelanggang::findOrFail($id);
        return view('pagesuperadmin.managegelanggang.show', compact('gelanggang'));
    }

    public function edit($id)
    {
        $gelanggang = Gelanggang::findOrFail($id);
        return view('pagesuperadmin.managegelanggang.edit', compact('gelanggang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_gelanggang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lokasi_gelanggang' => 'required|string|max:255',
            'maps' => 'required|string|max:255',
        ]);

        try {
            $gelanggang = Gelanggang::findOrFail($id);

            // Cek apakah user mengupload gambar baru
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($gelanggang->gambar && file_exists(public_path('image/gelanggang/' . $gelanggang->gambar))) {
                    unlink(public_path('image/gelanggang/' . $gelanggang->gambar));
                }

                $gambar = $request->file('gambar');
                $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
                
                // Pastikan folder tujuan ada
                $destinationPath = public_path('image/gelanggang');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                
                // Pindahkan file baru ke folder public/image/gelanggang
                $gambar->move($destinationPath, $gambarName);

                $gelanggang->update([
                    'nama_gelanggang' => $request->nama_gelanggang,
                    'deskripsi' => $request->deskripsi,
                    'gambar' => $gambarName,
                    'lokasi_gelanggang' => $request->lokasi_gelanggang,
                    'maps' => $request->maps,
                ]);
            } else {
                // Jika tidak ada gambar baru, update semua field kecuali gambar
                $gelanggang->update([
                    'nama_gelanggang' => $request->nama_gelanggang,
                    'deskripsi' => $request->deskripsi,
                    'lokasi_gelanggang' => $request->lokasi_gelanggang,
                    'maps' => $request->maps,
                ]);
            }

            Alert::toast('Data Gelanggang berhasil diperbarui', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('managegelanggang.index');
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
            $gelanggang = Gelanggang::findOrFail($id);

            // Hapus file gambar dari folder public
            if ($gelanggang->gambar && file_exists(public_path('image/gelanggang/' . $gelanggang->gambar))) {
                unlink(public_path('image/gelanggang/' . $gelanggang->gambar));
            }

            $gelanggang->delete();

            Alert::toast('Data Gelanggang berhasil dihapus', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('managegelanggang.index');
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat menghapus data', 'error')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->back();
        }
    }
}