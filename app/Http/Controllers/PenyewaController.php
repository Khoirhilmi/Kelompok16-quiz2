<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    public function index() {
        $penyewas = Penyewa::latest()->get();
        return view('penyewa.index', compact('penyewas'));
    }

    public function create() {
        return view('penyewa.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:15',
            'nomor_ktp' => 'required|string|unique:penyewa,nomor_ktp',
            'alamat_asal' => 'required',
            'pekerjaan' => 'required'
        ]);

        Penyewa::create($request->all());
        return redirect()->route('penyewa.index')->with('success', 'Penyewa berhasil didaftarkan');
    }

    public function destroy(string $id)
    {
        $penyewa = Penyewa::findOrFail($id);
        if ($penyewa->kontrakSewa()->where('status', 'aktif')->exists()) {
            return back()->with('error', 'Penyewa tidak bisa dihapus karena masih memiliki kontrak aktif!');
        }
        $penyewa->delete();
        return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil dihapus');
    }
}