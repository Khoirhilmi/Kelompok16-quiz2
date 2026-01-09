@extends('layouts.app')

@section('title', 'Daftar Kamar')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Kamar</h1>
        <a href="{{ route('kamar.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition">
            + Tambah Kamar
        </a>
    </div>

    <!-- Filter (Opsional/Bonus) -->
    <div class="bg-white p-4 rounded-lg shadow-sm flex gap-4">
        <form action="{{ route('kamar.index') }}" method="GET" class="flex gap-4">
            <select name="tipe" class="border rounded px-3 py-2">
                <option value="">Semua Tipe</option>
                <option value="standard">Standard</option>
                <option value="deluxe">Deluxe</option>
                <option value="vip">VIP</option>
            </select>
            <select name="status" class="border rounded px-3 py-2">
                <option value="">Semua Status</option>
                <option value="tersedia">Tersedia</option>
                <option value="terisi">Terisi</option>
            </select>
            <button type="submit" class="bg-gray-200 px-4 py-2 rounded">Filter</button>
        </form>
    </div>

    <!-- Tabel Kamar -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Kamar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/Bulan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($kamars as $kamar)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $kamar->nomor_kamar }}</td>
                    <td class="px-6 py-4 whitespace-nowrap uppercase text-sm">{{ $kamar->tipe }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($kamar->status == 'tersedia')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 text-uppercase">Tersedia</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 text-uppercase">Terisi</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                        <a href="{{ route('kamar.edit', $kamar->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kamar?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data kamar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection