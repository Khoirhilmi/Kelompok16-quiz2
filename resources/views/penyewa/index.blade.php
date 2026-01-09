@extends('layouts.app')

@section('title', 'Daftar Penyewa')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Penyewa</h1>
        <a href="{{ route('penyewa.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition">
            + Tambah Penyewa
        </a>
    </div>

    <!-- Tabel Penyewa -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pekerjaan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. KTP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                {{-- Pastikan variabelnya $penyewas (jamak) sesuai dengan yang dikirim Controller --}}
                @forelse($penyewas as $p)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $p->nama_lengkap }}</div>
                        <div class="text-xs text-gray-500">{{ $p->alamat_asal }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $p->nomor_telepon }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $p->pekerjaan }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $p->nomor_ktp }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-3">
                        {{-- Link Detail --}}
                        <a href="{{ route('penyewa.show', $p->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                        
                        {{-- Form Hapus --}}
                        <form action="{{ route('penyewa.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus penyewa ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Belum ada data penyewa.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection