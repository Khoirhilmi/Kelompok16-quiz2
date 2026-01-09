<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\KontrakSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index() {
        $pembayarans = Pembayaran::with('kontrakSewa.penyewa')->latest()->get();
        return view('pembayaran.index', compact('pembayarans'));
    }

    public function create(Request $request) {
        // Bisa pilih kontrak dari dropdown atau otomatis jika klik dari detail kontrak
        $kontraks = KontrakSewa::with('penyewa', 'kamar')->where('status', 'aktif')->get();
        $selected_id = $request->kontrak_id;
        return view('pembayaran.create', compact('kontraks', 'selected_id'));
    }

    public function store(Request $request) {
        $request->validate([
            'kontrak_sewa_id' => 'required',
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer',
            'jumlah_bayar' => 'required|numeric',
            'tanggal_bayar' => 'required|date',
            'bukti_transfer' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('bukti_transfer')) {
            $data['bukti_transfer'] = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        Pembayaran::create($data);
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dicatat!');
    }
}