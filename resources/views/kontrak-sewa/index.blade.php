@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Kontrak Sewa</h1>
        <a href="{{ route('kontrak-sewa.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Buat Kontrak Baru</a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 border-b">Penyewa</th>
                    <th class="p-4 border-b">Kamar</th>
                    <th class="p-4 border-b">Masa Sewa</th>
                    <th class="p-4 border-b">Status</th>
                    <th class="p-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kontraks as $k)
                <tr>
                    <td class="p-4 border-b">{{ $k->penyewa->nama_lengkap }}</td>
                    <td class="p-4 border-b">{{ $k->kamar->nomor_kamar }} ({{ ucfirst($k->kamar->tipe) }})</td>
                    <td class="p-4 border-b text-sm">
                        {{ $k->tanggal_mulai }} s/d {{ $k->tanggal_selesai }}
                    </td>
                    <td class="p-4 border-b">
                        <span class="px-2 py-1 rounded text-xs {{ $k->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($k->status) }}
                        </span>
                    </td>
                    <td class="p-4 border-b">
                        <a href="{{ route('kontrak-sewa.show', $k->id) }}" class="text-blue-600 hover:underline">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection