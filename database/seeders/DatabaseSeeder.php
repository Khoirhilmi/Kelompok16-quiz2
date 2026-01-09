<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kamar;
use App\Models\Penyewa;
use App\Models\KontrakSewa;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat User Admin (untuk login jika diperlukan)
        User::create([
            'name' => 'Admin Kost',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Buat Data Kamar (10 Kamar)
        $tipe = ['standard', 'deluxe', 'vip'];
        for ($i = 1; $i <= 10; $i++) {
            $currentTipe = $tipe[array_rand($tipe)];
            $harga = ($currentTipe == 'standard') ? 800000 : (($currentTipe == 'deluxe') ? 1200000 : 2000000);
            
            Kamar::create([
                'nomor_kamar' => 'A' . $i,
                'tipe' => $currentTipe,
                'harga_bulanan' => $harga,
                'fasilitas' => 'AC, WiFi, Lemari, Kasur',
                'status' => 'tersedia',
            ]);
        }

        // 3. Buat Data Penyewa (5 Orang)
        $daftarPenyewa = [
            ['nama' => 'Andi Wijaya', 'ktp' => '3201010101010001', 'kerja' => 'Mahasiswa'],
            ['nama' => 'Budi Setiawan', 'ktp' => '3201010101010002', 'kerja' => 'Karyawan'],
            ['nama' => 'Siti Aminah', 'ktp' => '3201010101010003', 'kerja' => 'Mahasiswa'],
            ['nama' => 'Riko Pratama', 'ktp' => '3201010101010004', 'kerja' => 'Karyawan'],
            ['nama' => 'Dewi Lestari', 'ktp' => '3201010101010005', 'kerja' => 'Freelance'],
        ];

        foreach ($daftarPenyewa as $p) {
            Penyewa::create([
                'nama_lengkap' => $p['nama'],
                'nomor_telepon' => '0812345678' . rand(10, 99),
                'nomor_ktp' => $p['ktp'],
                'alamat_asal' => 'Jl. Merdeka No. ' . rand(1, 100),
                'pekerjaan' => $p['kerja'],
            ]);
        }

        // 4. Buat Kontrak Sewa (3 Kontrak Aktif)
        $penyewas = Penyewa::take(3)->get();
        $kamars = Kamar::take(3)->get();

        foreach ($penyewas as $key => $penyewa) {
            $kamar = $kamars[$key];
            
            $kontrak = KontrakSewa::create([
                'penyewa_id' => $penyewa->id,
                'kamar_id' => $kamar->id,
                'tanggal_mulai' => now()->startOfMonth(),
                'tanggal_selesai' => now()->addMonths(6),
                'harga_bulanan' => $kamar->harga_bulanan,
                'status' => 'aktif',
            ]);

            // Update status kamar jadi terisi
            $kamar->update(['status' => 'terisi']);

            // 5. Buat Riwayat Pembayaran untuk setiap kontrak
            // Pembayaran Bulan Januari (Lunas)
            Pembayaran::create([
                'kontrak_sewa_id' => $kontrak->id,
                'bulan' => 1,
                'tahun' => 2026,
                'jumlah_bayar' => $kontrak->harga_bulanan,
                'tanggal_bayar' => now()->format('Y-m-d'),
                'status' => 'lunas',
                'keterangan' => 'Pembayaran bulan pertama',
            ]);

            // Buat 1 contoh tunggakan untuk testing dashboard
            if ($key == 0) {
                Pembayaran::create([
                    'kontrak_sewa_id' => $kontrak->id,
                    'bulan' => 2,
                    'tahun' => 2026,
                    'jumlah_bayar' => $kontrak->harga_bulanan,
                    'tanggal_bayar' => now()->addMonth()->format('Y-m-d'),
                    'status' => 'tertunggak',
                    'keterangan' => 'Belum bayar bulan Februari',
                ]);
            }
        }
    }
}