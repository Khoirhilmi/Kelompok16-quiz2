<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontrakSewa extends Model
{
    protected $table = 'kontrak_sewa';
    protected $fillable = ['penyewa_id', 'kamar_id', 'tanggal_mulai', 'tanggal_selesai', 'harga_bulanan', 'status'];

    // Relasi ke Penyewa
    public function penyewa() {
        return $this->belongsTo(Penyewa::class);
    }

    // Relasi ke Kamar
    public function kamar() {
        return $this->belongsTo(Kamar::class);
    }

    // Relasi ke Pembayaran
    public function pembayaran() {
        return $this->hasMany(Pembayaran::class);
    }
}