<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\UndianPacu;
use App\Models\Event;
use App\Models\Gelanggang;
use Illuminate\Http\Request;

class WebUndianPacuController extends Controller
{
    public function index(Request $request)
    {
        $query = UndianPacu::with('event', 'gelanggang');
        
        // Filter berdasarkan event
        if ($request->has('event_id') && $request->event_id) {
            $query->where('event_id', $request->event_id);
        }
        
        // Filter berdasarkan gelanggang
        if ($request->has('gelanggang_id') && $request->gelanggang_id) {
            $query->where('gelanggang_id', $request->gelanggang_id);
        }
        
        $undianPacu = $query->latest()->paginate(12);
        $events = Event::all();
        $gelanggangs = Gelanggang::all();
        
        return view('pageuser.undianpacu.index', compact('undianPacu', 'events', 'gelanggangs'));
    }

    public function detail($id)
    {
        $undianPacu = UndianPacu::with('event', 'gelanggang')->findOrFail($id);
        $undianPacuTerbaru = UndianPacu::with('event', 'gelanggang')
            ->where('id', '!=', $id)
            ->latest()
            ->take(4)
            ->get();
        
        return view('pageuser.undianpacu.detail', compact('undianPacu', 'undianPacuTerbaru'));
    }
}
