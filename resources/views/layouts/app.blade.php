<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Kost')</title>
    
    {{-- TODO: Include Vite CSS (Tailwind) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    {{-- TODO: Buat navbar dengan menu navigasi --}}
    <nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16 items-center"> <!-- Tambahkan items-center -->
            {{-- Logo --}}
            <div class="flex items-center">
                <span class="text-xl font-bold text-blue-600">Sistem Kost Pak Budi</span>
            </div>
            
            {{-- Menu Navigasi --}}
                <div class="flex space-x-6"> <!-- space-x-6 memberikan jarak antar menu -->
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 font-medium">Dashboard</a>
                    <a href="{{ route('kamar.index') }}" class="text-gray-600 hover:text-blue-600 font-medium">Kamar</a>
                    <a href="{{ route('penyewa.index') }}" class="text-gray-600 hover:text-blue-600 font-medium">Penyewa</a>
                    <a href="{{ route('kontrak-sewa.index') }}" class="text-gray-600 hover:text-blue-600 font-medium">Kontrak</a>
                    <a href="{{ route('pembayaran.index') }}" class="text-gray-600 hover:text-blue-600 font-medium">Pembayaran</a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto py-6 px-4">
        {{-- TODO: Tampilkan flash messages (success/error) --}}
        
        @yield('content')
    </main>

    {{-- TODO: Footer (opsional) --}}
</body>
</html>
