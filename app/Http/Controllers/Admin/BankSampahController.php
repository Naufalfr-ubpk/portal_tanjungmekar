<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriSampah;
use App\Models\TransaksiSampah;
use App\Models\User;
use Illuminate\Http\Request;

class BankSampahController extends Controller
{
    public function index()
    {
        // Ambil data untuk ditampilkan di tabel
        $kategori = KategoriSampah::orderBy('nama_kategori', 'asc')->get();
        $transaksi = TransaksiSampah::with(['user', 'kategoriSampah'])->latest()->get();
        
        // Ambil daftar warga untuk dropdown pilihan "Nama Warga" saat input setoran
        $warga = User::where('role', 'user')->orderBy('name', 'asc')->get();

        return view('admin.bank-sampah.index', compact('kategori', 'transaksi', 'warga'));
    }

    // FUNGSI SIMPAN KATEGORI HARGA
    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'harga_per_satuan' => 'required|numeric|min:0',
        ]);

        KategoriSampah::create($request->all());
        return back()->with('success', 'Kategori sampah berhasil ditambahkan!');
    }

    // FUNGSI SIMPAN TRANSAKSI SETORAN
    public function storeTransaksi(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kategori_id' => 'required|exists:kategori_sampahs,id',
            'berat_jumlah' => 'required|numeric|min:0.1',
            'tanggal_setor' => 'required|date',
        ]);

        // Cari tahu harga per satuan dari kategori yang dipilih
        $kategori = KategoriSampah::findOrFail($request->kategori_id);
        
        // Kalkulasi otomatis: Berat x Harga per Satuan
        $total_harga = $kategori->harga_per_satuan * $request->berat_jumlah;

        TransaksiSampah::create([
            'user_id' => $request->user_id,
            'kategori_id' => $request->kategori_id,
            'berat_jumlah' => $request->berat_jumlah,
            'total_harga' => $total_harga,
            'tanggal_setor' => $request->tanggal_setor,
        ]);

        return back()->with('success', 'Setoran warga berhasil dicatat!');
    }
}