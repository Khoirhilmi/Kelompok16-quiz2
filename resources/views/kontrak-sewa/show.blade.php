@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4 border-b pb-2">Detail Kontrak #{{ $kontrak->id }}</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-500">Penyewa</p>
                <p class="font-bold text-lg">{{ $kontrak->penyewa->nama_lengkap }}</p>
            </div>
            <div>
                <p class="text-gray-500">Kamar</p>
                <p class="font-bold text-lg">{{ $kontrak->kamar->nomor_kamar }}</p>
            </div>
            <div>
                <p class="text-gray-500">Masa Sewa</p>
                <p>{{ $kontrak->tanggal_mulai }} s/d {{ $kontrak->tanggal_selesai }}</p>
            </div>
            <div>
                <p class="text-gray-500">Status</p>
                <span class="px-2 py-1 rounded text-xs {{ $kontrak->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ ucfirst($kontrak->status) }}
                </span>
            </div>
        </div>

        @if($kontrak->status == 'aktif')
        <form action="{{ route('kontrak-sewa.update', $kontrak->id) }}" method="POST" class="mt-6 border-t pt-4">
            @csrf @method('PUT')
            <input type="hidden" name="status" value="selesai">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded text-sm" onclick="return confirm('Selesaikan kontrak ini?')">Akhiri Kontrak & Kosongkan Kamar</button>
        </form>
        @endif
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-bold mb-4">Riwayat Pembayaran Kontrak Ini</h3>
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-2">Bulan/Tahun</th>
                    <th class="p-2">Jumlah</th>
                    <th class="p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kontrak->pembayaran as $p)
                <tr class="border-b">
                    <td class="p-2">{{ $p->bulan }}/{{ $p->tahun }}</td>
                    <td class="p-2">Rp {{ number_format($p->jumlah_bayar) }}</td>
                    <td class="p-2">{{ ucfirst($p->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection