@extends('layouts.app')
@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">Daftar Penyewa</h1>
        <a href="{{ route('penyewa.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Penyewa</a>
    </div>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4">Nama</th>
                    <th class="p-4">Telepon</th>
                    <th class="p-4">KTP</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penyewas as $p)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-bold">{{ $p->nama_lengkap }}</td>
                    <td class="p-4">{{ $p->nomor_telepon }}</td>
                    <td class="p-4">{{ $p->nomor_ktp }}</td>
                    <td class="p-4 flex gap-2">
                        <form action="{{ route('penyewa.destroy', $p->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">Belum ada data penyewa</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection