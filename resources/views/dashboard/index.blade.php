@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <h1 class="text-3xl font-bold text-gray-900">Dashboard Statistik</h1>
     {{-- TODO: Buat cards untuk statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- TODO: Tampilkan total kamar --}}
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="text-sm text-gray-500 font-bold uppercase">Total Kamar</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['total_kamar'] }}</div>
        </div>

        {{-- TODO: Card Kamar Terisi --}}
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="text-sm text-gray-500 font-bold uppercase">Kamar Terisi</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['kamar_terisi'] }}</div>
        </div>

        {{-- TODO: Card Kamar Tersedia --}}
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <div class="text-sm text-gray-500 font-bold uppercase">Kamar Tersedia</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['kamar_tersedia'] }}</div>
        </div>

        {{-- TODO: Card Pendapatan Bulan Ini --}}
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <div class="text-sm text-gray-500 font-bold uppercase">Pendapatan Bulan Ini</div>
            <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['pendapatan_bulan_ini'], 0, ',', '.') }}</div>
        </div>
    </div>
</div>
@endsection