<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSampah extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori_sampah_id',
        'berat_jumlah',
        'total_harga',
        'tanggal_setor',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategoriSampah()
    {
        return $this->belongsTo(KategoriSampah::class);
    }
}