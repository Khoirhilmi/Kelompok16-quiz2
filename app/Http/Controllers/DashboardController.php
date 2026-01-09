<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Pastikan variabel $stats ini ada datanya
        $stats = [
            'total_kamar' => \App\Models\Kamar::count(),
            'kamar_tersedia' => \App\Models\Kamar::where('status', 'tersedia')->count(),
            'kamar_terisi' => \App\Models\Kamar::where('status', 'terisi')->count(),
            'pendapatan_bulan_ini' => \App\Models\Pembayaran::where('status', 'lunas')->sum('jumlah_bayar'),
            'pembayaran_tertunggak' => \App\Models\Pembayaran::where('status', 'tertunggak')->count(),
        ];
        
        // Pastikan mengarah ke dashboard.index (sesuai folder resources/views/dashboard/index.blade.php)
        return view('dashboard.index', compact('stats'));
    }
}