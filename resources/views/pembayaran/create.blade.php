@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-6">Catat Pembayaran Baru</h2>
    
    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block mb-2">Pilih Kontrak (Penyewa)</label>
            <select name="kontrak_sewa_id" class="w-full border p-2 rounded">
                @foreach($kontraks as $k)
                    <option value="{{ $k->id }}" {{ $selected_id == $k->id ? 'selected' : '' }}>
                        {{ $k->penyewa->nama_lengkap }} - Kamar {{ $k->kamar->nomor_kamar }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block mb-2">Bulan (1-12)</label>
                <input type="number" name="bulan" min="1" max="12" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block mb-2">Tahun</label>
                <input type="number" name="tahun" value="{{ date('Y') }}" class="w-full border p-2 rounded" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Tanggal Bayar</label>
            <input type="date" name="tanggal_bayar" value="{{ date('Y-m-d') }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-2">Bukti Transfer (Opsional)</label>
            <input type="file" name="bukti_transfer" class="w-full">
        </div>

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded shadow">Simpan Pembayaran</button>
    </form>
</div>
@endsection