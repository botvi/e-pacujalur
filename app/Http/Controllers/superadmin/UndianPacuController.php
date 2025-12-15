<?php

namespace App\Http\Controllers\superadmin;

use App\Models\Event;
use App\Models\UndianPacu;
use App\Models\Gelanggang;
use App\Models\Jalur;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UndianPacuExport;

class UndianPacuController extends Controller
{
    public function index()
    {
        $undianPacu = UndianPacu::with('event', 'gelanggang')->get();
        $jalur = Jalur::all()->keyBy('id');
        return view('pagesuperadmin.manageundianpacu.index', compact('undianPacu', 'jalur'));
    }

    public function create()
    {
        $event = Event::all();
        $gelanggang = Gelanggang::all();
        $jalur = Jalur::all();
        return view('pagesuperadmin.manageundianpacu.create', compact('event', 'gelanggang', 'jalur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'gelanggang_id' => 'required|exists:gelanggangs,id',
            'jalur_peserta' => 'required|array|min:2',
            'jalur_peserta.*' => 'integer|exists:jalurs,id',
            'participants' => 'required|array',
            'tanggal' => 'required|date',
            'jam' => 'required|string|max:255',
        ]);

        $participants = [
            'peserta' => $request->jalur_peserta,
            'pairing' => $request->participants,
        ];

        UndianPacu::create([
            'event_id' => $request->event_id,
            'gelanggang_id' => $request->gelanggang_id,
            'participants' => $participants,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
        ]);

        Alert::toast('Data Undian Pacu berhasil ditambahkan', 'success')
            ->position('top-end')
            ->timerProgressBar();
        return redirect()->route('manageundianpacu.index');
    }

    public function show($id)
    {
        $undianPacu = UndianPacu::with('event', 'gelanggang')->findOrFail($id);
        $jalur = Jalur::all()->keyBy('id');
        return view('pagesuperadmin.manageundianpacu.show', compact('undianPacu', 'jalur'));
    }

    public function edit($id)
    {
        $event = Event::all();
        $gelanggang = Gelanggang::all();
        $jalur = Jalur::all();
        $undianPacu = UndianPacu::with('event', 'gelanggang')->findOrFail($id);
        return view('pagesuperadmin.manageundianpacu.edit', compact('undianPacu', 'event', 'gelanggang', 'jalur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'gelanggang_id' => 'required|exists:gelanggangs,id',
            'jalur_peserta' => 'required|array|min:2',
            'jalur_peserta.*' => 'integer|exists:jalurs,id',
            'participants' => 'required|array',
            'tanggal' => 'required|date',
            'jam' => 'required|string|max:255',
        ]);

        $participants = [
            'peserta' => $request->jalur_peserta,
            'pairing' => $request->participants,
        ];

        $undianPacu = UndianPacu::findOrFail($id);

        $undianPacu->update([
            'event_id' => $request->event_id,
            'gelanggang_id' => $request->gelanggang_id,
            'participants' => $participants,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
        ]);

        Alert::toast('Data Undian Pacu berhasil diperbarui', 'success')
            ->position('top-end')
            ->timerProgressBar();
        return redirect()->route('manageundianpacu.index');
    }

    public function destroy($id)
    {
        $undianPacu = UndianPacu::findOrFail($id);
        $undianPacu->delete();
        Alert::toast('Data Undian Pacu berhasil dihapus', 'success')
            ->position('top-end')
            ->timerProgressBar();
        return redirect()->route('manageundianpacu.index');
    }

    public function export($id)
    {
        $undianPacu = UndianPacu::with('event', 'gelanggang')->findOrFail($id);
        $jalur = Jalur::all()->keyBy('id');

        $fileName = 'undian_pacu_' . $undianPacu->id . '_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new UndianPacuExport($undianPacu, $jalur), $fileName);
    }
}
