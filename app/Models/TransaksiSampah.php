<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiSampah extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi
    protected $fillable = ['user_id', 'kategori_id', 'berat_jumlah', 'total_harga', 'tanggal_setor'];

    // Relasi: Transaksi ini punya siapa? (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Transaksi ini kategori sampahnya apa?
    public function kategoriSampah()
    {
        return $this->belongsTo(KategoriSampah::class, 'kategori_id');
    }
}