@extends('layouts.app')

@section('title', 'Tambah Penyewa')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Tambah Penyewa Baru</h1>

    <form action="{{ route('penyewa.store') }}" method="POST"
          class="bg-white shadow-md rounded-lg p-6 space-y-4">
        @csrf

        {{-- Nama Lengkap --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="nama_lengkap"
                   value="{{ old('nama_lengkap') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('nama_lengkap')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nomor Telepon --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
            <input type="text" name="nomor_telepon"
                   value="{{ old('nomor_telepon') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('nomor_telepon')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nomor KTP --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Nomor KTP</label>
            <input type="text" name="nomor_ktp"
                   value="{{ old('nomor_ktp') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('nomor_ktp')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>




        {{-- Alamat Asal --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Alamat Asal</label>
            <textarea name="alamat_asal" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('alamat_asal') }}</textarea>
            @error('alamat_asal')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Pekerjaan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Pekerjaan</label>
            <input type="text" name="pekerjaan"
                   value="{{ old('pekerjaan') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('pekerjaan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        

        <div class="flex justify-end space-x-2">
            <a href="{{ route('penyewa.index') }}"
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
