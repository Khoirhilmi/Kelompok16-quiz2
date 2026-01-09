<?php

namespace App\Http\Controllers;

use App\Models\KontrakSewa;
use App\Models\Kamar;
use App\Models\Penyewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KontrakSewaController extends Controller
{
    public function index() {
        $kontraks = KontrakSewa::with(['penyewa', 'kamar'])->latest()->get();
        return view('kontrak-sewa.index', compact('kontraks'));
    }

    public function create() {
        $penyewas = Penyewa::all();
        // Hanya ambil kamar yang statusnya 'tersedia'
        $kamars = Kamar::where('status', 'tersedia')->get();
        return view('kontrak-sewa.create', compact('penyewas', 'kamars'));
    }

    public function store(Request $request) {
        $request->validate([
            'penyewa_id' => 'required',
            'kamar_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'harga_bulanan' => 'required|numeric',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Simpan Kontrak
            KontrakSewa::create($request->all());
            
            // 2. Update status kamar jadi 'terisi'
            Kamar::where('id', $request->kamar_id)->update(['status' => 'terisi']);
        });

        return redirect()->route('kontrak-sewa.index')->with('success', 'Kontrak berhasil dibuat!');
    }

    public function show($id) {
        $kontrak = KontrakSewa::with(['penyewa', 'kamar', 'pembayaran'])->findOrFail($id);
        return view('kontrak-sewa.show', compact('kontrak'));
    }

    public function update(Request $request, $id) {
        $kontrak = KontrakSewa::findOrFail($id);
        $kontrak->update(['status' => $request->status]);

        // Jika kontrak selesai, kembalikan status kamar jadi tersedia
        if($request->status == 'selesai') {
            Kamar::where('id', $kontrak->kamar_id)->update(['status' => 'tersedia']);
        }

        return back()->with('success', 'Status kontrak diperbarui!');
    }
}