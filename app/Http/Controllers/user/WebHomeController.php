<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Jalur;
use App\Models\Gelanggang;
use App\Models\UndianPacu;
use App\Models\JuaraPacuJalur;
use Illuminate\Http\Request;

class WebHomeController extends Controller
{
    public function index()
    {
        $events = Event::latest()->take(3)->get();
        $jalurs = Jalur::latest()->take(6)->get();
        $gelanggangs = Gelanggang::latest()->take(4)->get();
        $undianPacu = UndianPacu::with('event', 'gelanggang')->latest()->take(3)->get();
        $juaraPacuJalur = JuaraPacuJalur::with('event', 'gelanggang')->latest()->take(3)->get();
        
        return view('pageuser.home.index', compact('events', 'jalurs', 'gelanggangs', 'undianPacu', 'juaraPacuJalur'));
    }
}
