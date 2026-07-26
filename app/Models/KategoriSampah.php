<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSampah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'satuan',
        'harga_per_satuan',
    ];

    public function transaksi()
    {
        return $this->hasMany(TransaksiSampah::class);
    }
}