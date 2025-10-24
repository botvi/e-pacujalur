<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\JuaraPacuJalur;
use App\Models\Event;
use App\Models\Gelanggang;
use App\Models\Jalur;
use Illuminate\Http\Request;

class WebJuaraPacuJalurController extends Controller
{
    public function index(Request $request)
    {
        $query = JuaraPacuJalur::with('event', 'gelanggang');
        
        // Pencarian berdasarkan event, gelanggang, atau tahun
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('tahun', 'like', "%{$search}%")
                  ->orWhereHas('event', function($eventQuery) use ($search) {
                      $eventQuery->where('nama_event', 'like', "%{$search}%");
                  })
                  ->orWhereHas('gelanggang', function($gelanggangQuery) use ($search) {
                      $gelanggangQuery->where('nama_gelanggang', 'like', "%{$search}%");
                  });
            });
        }
        
        // Filter berdasarkan event
        if ($request->has('event_id') && $request->event_id) {
            $query->where('event_id', $request->event_id);
        }
        
        // Filter berdasarkan gelanggang
        if ($request->has('gelanggang_id') && $request->gelanggang_id) {
            $query->where('gelanggang_id', $request->gelanggang_id);
        }
        
        // Filter berdasarkan tahun
        if ($request->has('tahun') && $request->tahun) {
            $query->where('tahun', $request->tahun);
        }
        
        $juaraPacuJalur = $query->latest()->paginate(12)->withQueryString();
        $events = Event::all();
        $gelanggangs = Gelanggang::all();
        $tahunList = JuaraPacuJalur::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        
        return view('pageuser.juarapacujalur.index', compact('juaraPacuJalur', 'events', 'gelanggangs', 'tahunList'));
    }

    public function detail($id)
    {
        $juara = JuaraPacuJalur::with('event', 'gelanggang')->findOrFail($id);
        $jalur = Jalur::all();
        $juaraLainnya = JuaraPacuJalur::where('id', '!=', $id)
            ->with('event', 'gelanggang')
            ->latest()
            ->take(4)
            ->get();
        
        return view('pageuser.juarapacujalur.detail', compact('juara', 'juaraLainnya', 'jalur'));
    }
}
