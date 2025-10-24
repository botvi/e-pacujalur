<?php

namespace App\Http\Controllers\superadmin;

use App\Models\Event;
use App\Models\UndianPacu;
use App\Models\Gelanggang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UndianPacuController extends Controller
{
    public function index()
    {
        $undianPacu = UndianPacu::with('event', 'gelanggang')->get();
        return view('pagesuperadmin.manageundianpacu.index', compact('undianPacu'));
    }

    public function create()
    {
        $event = Event::all();
        $gelanggang = Gelanggang::all();
        return view('pagesuperadmin.manageundianpacu.create', compact('event', 'gelanggang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'gelanggang_id' => 'required|exists:gelanggangs,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tanggal' => 'required|date',
            'jam' => 'required|string|max:255',
        ]);

        try {
            $gambar = $request->file('gambar');
            $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
            
            // Pastikan folder tujuan ada
            $destinationPath = public_path('image/undianpacu');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            // Pindahkan file ke folder public/image/jalur
            $gambar->move($destinationPath, $gambarName);

        UndianPacu::create([
            'event_id' => $request->event_id,
            'gelanggang_id' => $request->gelanggang_id,
            'gambar' => $gambarName,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
        ]);

            Alert::toast('Data Undian Pacu berhasil ditambahkan', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('manageundianpacu.index');
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat menyimpan data', 'error')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        $undianPacu = UndianPacu::with('event', 'gelanggang')->findOrFail($id);
        return view('pagesuperadmin.manageundianpacu.show', compact('undianPacu'));
    }

    public function edit($id)
    {
        $event = Event::all();
        $gelanggang = Gelanggang::all();
        $undianPacu = UndianPacu::with('event', 'gelanggang')->findOrFail($id);
        return view('pagesuperadmin.manageundianpacu.edit', compact('undianPacu', 'event', 'gelanggang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'gelanggang_id' => 'required|exists:gelanggangs,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tanggal' => 'required|date',
            'jam' => 'required|string|max:255',
        ]);

        try {
            $undianPacu = UndianPacu::findOrFail($id);

            // Cek apakah user mengupload gambar baru
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($undianPacu->gambar && file_exists(public_path('image/undianpacu/' . $undianPacu->gambar))) {
                    unlink(public_path('image/undianpacu/' . $undianPacu->gambar));
                }

                $gambar = $request->file('gambar');
                $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
                
                // Pastikan folder tujuan ada
                $destinationPath = public_path('image/undianpacu');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                
                // Pindahkan file baru ke folder public/image/jalur
                $gambar->move($destinationPath, $gambarName);

                    $undianPacu->update([
                    'event_id' => $request->event_id,
                    'gelanggang_id' => $request->gelanggang_id,
                    'tanggal' => $request->tanggal,
                    'jam' => $request->jam,
                    'gambar' => $gambarName,
                ]);
            } else {
                // Jika tidak ada gambar baru, update semua field kecuali gambar
                $undianPacu->update([
                    'event_id' => $request->event_id,
                    'gelanggang_id' => $request->gelanggang_id,
                    'tanggal' => $request->tanggal,
                    'jam' => $request->jam,
                ]);
            }

            Alert::toast('Data Undian Pacu berhasil diperbarui', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('manageundianpacu.index');
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
            $undianPacu = UndianPacu::findOrFail($id);

            // Hapus file gambar dari folder public
            if ($undianPacu->gambar && file_exists(public_path('image/undianpacu/' . $undianPacu->gambar))) {
                unlink(public_path('image/undianpacu/' . $undianPacu->gambar));
            }

            $undianPacu->delete();

            Alert::toast('Data Undian Pacu berhasil dihapus', 'success')
                ->position('top-end')
                ->timerProgressBar();
                return redirect()->route('manageundianpacu.index');
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat menghapus data', 'error')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->back();
        }
    }
}