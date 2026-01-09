@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Riwayat Pembayaran</h1>
        <a href="{{ route('pembayaran.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg">Catat Bayar</a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-left">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Penyewa</th>
                    <th class="px-6 py-3">Periode</th>
                    <th class="px-6 py-3">Nominal</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Bukti</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($pembayarans as $p)
                <tr>
                    <td class="px-6 py-4">{{ $p->kontrakSewa->penyewa->nama_lengkap }}</td>
                    <td class="px-6 py-4">{{ $p->bulan }}/{{ $p->tahun }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs {{ $p->status == 'lunas' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($p->bukti_transfer)
                            <a href="{{ asset('storage/'.$p->bukti_transfer) }}" target="_blank" class="text-blue-500 underline">Lihat</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection