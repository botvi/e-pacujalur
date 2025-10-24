<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Jalur;
use Illuminate\Http\Request;

class WebDaftarJalurController extends Controller
{
    public function index(Request $request)
    {
        $query = Jalur::query();
        
        // Pencarian berdasarkan nama jalur, asal jalur, atau tahun
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_jalur', 'like', "%{$search}%")
                  ->orWhere('asal_jalur', 'like', "%{$search}%")
                  ->orWhere('tahun_buat', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }
        
        $jalurs = $query->latest()->paginate(12)->withQueryString();
        return view('pageuser.daftarjalur.index', compact('jalurs'));
    }

    public function detail($id)
    {
        $jalur = Jalur::findOrFail($id);
        $jalursTerbaru = Jalur::where('id', '!=', $id)->latest()->take(4)->get();
        
        return view('pageuser.daftarjalur.detail', compact('jalur', 'jalursTerbaru'));
    }
}
