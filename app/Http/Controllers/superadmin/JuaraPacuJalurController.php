<?php

namespace App\Http\Controllers\superadmin;

use App\Models\Gelanggang;
use App\Models\JuaraPacuJalur;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Jalur;
use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class JuaraPacuJalurController extends Controller
{
    public function index()
    {
        $jalur = Jalur::all();
        $gelanggang = Gelanggang::all();
        $event = Event::all();
        $juaraPacuJalur = JuaraPacuJalur::with('gelanggang', 'event')->get();
        return view('pagesuperadmin.managejuarapacujalur.index', compact('juaraPacuJalur', 'jalur', 'gelanggang', 'event'));
    }

    public function create()
    {
        $jalur = Jalur::all();
        $gelanggang = Gelanggang::all();
        $event = Event::all();
        return view('pagesuperadmin.managejuarapacujalur.create', compact('jalur', 'gelanggang', 'event'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gelanggang_id' => 'required|exists:gelanggangs,id',
            'event_id' => 'required|exists:events,id',
            'tahun' => 'required|string|max:4',
            'daftar_juara' => 'required|array',
            'daftar_juara.*.jalur_id' => 'required|string|max:255',
        ]);

        try {
            $daftar_juara = $request->daftar_juara;
            $daftar_juara = json_encode($daftar_juara);

            JuaraPacuJalur::create([
                'gelanggang_id' => $request->gelanggang_id,
                'event_id' => $request->event_id,
                'tahun' => $request->tahun,
                'daftar_juara' => $daftar_juara,
            ]);

            Alert::toast('Data Juara Pacu Jalur berhasil ditambahkan', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('managejuarapacujalur.index');
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat menyimpan data', 'error')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        $juaraPacuJalur = JuaraPacuJalur::with('gelanggang', 'event')->findOrFail($id);
        return view('pagesuperadmin.managejuarapacujalur.show', compact('juaraPacuJalur'));
    }

    public function edit($id)
    {
        $jalur = Jalur::all();
        $gelanggang = Gelanggang::all();
        $event = Event::all();
        $juaraPacuJalur = JuaraPacuJalur::with('gelanggang', 'event')->findOrFail($id);
        return view('pagesuperadmin.managejuarapacujalur.edit', compact('juaraPacuJalur', 'jalur', 'gelanggang', 'event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gelanggang_id' => 'required|exists:gelanggangs,id',
            'event_id' => 'required|exists:events,id',
            'tahun' => 'required|string|max:4',
            'daftar_juara' => 'required|array',
            'daftar_juara.*.jalur_id' => 'required|string|max:255',
        ]);

        try {
            $juaraPacuJalur = JuaraPacuJalur::with('gelanggang', 'event')->findOrFail($id);
            $daftar_juara = $request->daftar_juara;
            $daftar_juara = json_encode($daftar_juara);

            $juaraPacuJalur->update([
                'gelanggang_id' => $request->gelanggang_id,
                'event_id' => $request->event_id,
                'tahun' => $request->tahun,
                'daftar_juara' => $daftar_juara,
            ]);

            Alert::toast('Data Juara Pacu Jalur berhasil diperbarui', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('managejuarapacujalur.index');
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
            $juaraPacuJalur = JuaraPacuJalur::with('gelanggang', 'event')->findOrFail($id);
            $juaraPacuJalur->delete();

            Alert::toast('Data Juara Pacu Jalur berhasil dihapus', 'success')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->route('managejuarapacujalur.index');
        } catch (\Exception $e) {
            Alert::toast('Terjadi kesalahan saat menghapus data', 'error')
                ->position('top-end')
                ->timerProgressBar();
            return redirect()->back();
        }
    }
}