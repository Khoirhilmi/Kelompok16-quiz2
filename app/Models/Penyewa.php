<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    protected $table = 'penyewa';
    
    // TODO: Definisikan kolom yang dapat diisi (mass assignment)
    
    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'nomor_ktp',
        'alamat_asal',
        'pekerjaan' 
    ];

    public function kontrakSewa()
    {
        return $this->hasMany(KontrakSewa::class);
    }
}
