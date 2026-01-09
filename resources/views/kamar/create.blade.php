@extends('layouts.app')

@section('title', 'Tambah Kamar')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Tambah Kamar Baru</h1>

    {{-- Form tambah kamar --}}
    <form action="{{ route('kamar.store') }}" method="POST"
          class="bg-white shadow-md rounded-lg p-6 space-y-4">
        @csrf

        {{-- Nomor Kamar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor Kamar</label>
            <input type="text" name="nomor_kamar"
                   value="{{ old('nomor_kamar') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('nomor_kamar')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tipe Kamar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tipe Kamar</label>
            <select name="tipe"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">-- Pilih Tipe --</option>
                <option value="standard" {{ old('tipe')=='standard'?'selected':'' }}>Standard</option>
                <option value="deluxe" {{ old('tipe')=='deluxe'?'selected':'' }}>Deluxe</option>
                <option value="vip" {{ old('tipe')=='vip'?'selected':'' }}>VIP</option>
            </select>
            @error('tipe')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Harga Bulanan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Harga Bulanan</label>
            <input type="number" name="harga_bulanan"
                   value="{{ old('harga_bulanan') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('harga_bulanan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Fasilitas --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Fasilitas</label>
            <textarea name="fasilitas" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('fasilitas') }}</textarea>
            @error('fasilitas')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="tersedia" {{ old('status')=='tersedia'?'selected':'' }}>Tersedia</option>
                <option value="terisi" {{ old('status')=='terisi'?'selected':'' }}>Terisi</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('kamar.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Batal
            </a>
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
