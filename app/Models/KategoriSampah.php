<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSampah extends Model
{
    use HasFactory;
    
    // Kolom yang boleh diisi
    protected $fillable = ['nama_kategori', 'satuan', 'harga_per_satuan'];

    // Relasi: 1 Kategori bisa punya banyak transaksi setoran
    public function transaksi()
    {
        return $this->hasMany(TransaksiSampah::class, 'kategori_id');
    }
}