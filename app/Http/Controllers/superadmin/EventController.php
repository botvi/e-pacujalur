<?php

namespace App\Http\Controllers\superadmin;

use App\Models\Event;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::all();
        return view('pagesuperadmin.manageevent.index', compact('event'));
    }

    public function create()
    {
        return view('pagesuperadmin.manageevent.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $gambar = $request->file('gambar');
            $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
            
            // Pastikan folder tujuan ada
            $destinationPath = public_path('image/event');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $gambar->move($destinationPath, $gambarName);
            Event::create([
                'nama_event' => $request->nama_event,
                'deskripsi' => $request->deskripsi,
                'gambar' => $gambarName,
            ]);

            Alert::toast('Data Event berhasil ditambahkan', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('manageevent.index');
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat menyimpan data', 'error')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('pagesuperadmin.manageevent.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('pagesuperadmin.manageevent.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $event = Event::findOrFail($id);

            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($event->gambar && file_exists(public_path('image/event/' . $event->gambar))) {
                    unlink(public_path('image/event/' . $event->gambar));
                }

                $gambar = $request->file('gambar');
                $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
                
                // Pastikan folder tujuan ada
                $destinationPath = public_path('image/event');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                
                $gambar->move($destinationPath, $gambarName);
                $event->update([
                    'gambar' => $gambarName,
                ]);
            }
            $event->update([
                'nama_event' => $request->nama_event,
                'deskripsi' => $request->deskripsi,
            ]);

            Alert::toast('Data Event berhasil diperbarui', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('manageevent.index');
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
            $event = Event::findOrFail($id);

            // Hapus file gambar dari folder public
            if ($event->gambar && file_exists(public_path('image/event/' . $event->gambar))) {
                unlink(public_path('image/event/' . $event->gambar));
            }

            $event->delete();

            Alert::toast('Data Event berhasil dihapus', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('manageevent.index');
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat menghapus data', 'error')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->back();
        }
    }
}