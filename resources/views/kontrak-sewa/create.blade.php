@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Buat Kontrak Baru</h2>
    <form action="{{ route('kontrak-sewa.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="block mb-1 font-semibold">Penyewa</label>
                <select name="penyewa_id" class="w-full border p-2 rounded">
                    @foreach($penyewas as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-1 font-semibold">Kamar (Tersedia)</label>
                <select name="kamar_id" class="w-full border p-2 rounded">
                    @foreach($kamars as $k)
                        <option value="{{ $k->id }}">{{ $k->nomor_kamar }} - {{ ucfirst($k->tipe) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="w-full border p-2 rounded" required>
                </div>
            </div>
            <div>
                <label class="block mb-1 font-semibold">Harga Bulanan (Rp)</label>
                <input type="number" name="harga_bulanan" class="w-full border p-2 rounded" required>
            </div>
        </div>
        <button type="submit" class="mt-6 bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700 w-full">Simpan Kontrak</button>
    </form>
</div>
@endsection