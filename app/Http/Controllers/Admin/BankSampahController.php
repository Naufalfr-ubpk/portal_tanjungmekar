<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriSampah;
use App\Models\TransaksiSampah;
use Illuminate\Http\Request;

class BankSampahController extends Controller
{
    public function index()
    {
        // Ambil data jenis sampah dan harganya
        $kategori = KategoriSampah::orderBy('nama_kategori', 'asc')->get();
        
        // Ambil riwayat setoran warga
        $transaksi = TransaksiSampah::with(['user', 'kategoriSampah'])->latest()->get();
        
        return view('admin.bank-sampah.index', compact('kategori', 'transaksi'));
    }
}