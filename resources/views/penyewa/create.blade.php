@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Tambah Penyewa Baru</h2>
    <form action="{{ route('penyewa.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block mb-1">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block mb-1">Nomor KTP</label>
                <input type="text" name="nomor_ktp" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block mb-1">Pekerjaan</label>
                <input type="text" name="pekerjaan" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block mb-1">Alamat Asal</label>
                <textarea name="alamat_asal" class="w-full border p-2 rounded" rows="3" required></textarea>
            </div>
        </div>
        <button type="submit" class="mt-6 bg-blue-600 text-white px-6 py-2 rounded shadow w-full">Daftarkan Penyewa</button>
    </form>
</div>
@endsection