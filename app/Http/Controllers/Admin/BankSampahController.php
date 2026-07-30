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
        try {
            $kategori = KategoriSampah::orderBy('nama_kategori', 'asc')->get();
            $transaksi = TransaksiSampah::with(['user', 'kategoriSampah'])->latest()->get();
            $warga = User::where('role', 'user')->orderBy('name', 'asc')->get();

            return view('admin.bank-sampah.index', compact('kategori', 'transaksi', 'warga'));
        } catch (\Exception $e) {
            dd("CRASH SAAT MEMUAT HALAMAN. PESAN ERROR DB: " . $e->getMessage());
        }
    }

    public function storeKategori(Request $request)
    {
        try {
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
                'satuan' => 'required|string|max:50',
                'harga_per_satuan' => 'required|numeric|min:0',
            ]);

            KategoriSampah::create($request->all());
            return back()->with('success', 'Kategori sampah berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan kategori. Info Error: ' . $e->getMessage());
        }
    }

    public function storeTransaksi(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'kategori_id' => 'required|exists:kategori_sampahs,id',
                'berat_jumlah' => 'required|numeric|min:0.1',
                'tanggal_setor' => 'required|date',
            ]);

            $kategori = KategoriSampah::findOrFail($request->kategori_id);
            $total_harga = $kategori->harga_per_satuan * $request->berat_jumlah;

            TransaksiSampah::create([
                'user_id' => $request->user_id,
                'kategori_id' => $request->kategori_id,
                'berat_jumlah' => $request->berat_jumlah,
                'total_harga' => $total_harga,
                'tanggal_setor' => $request->tanggal_setor,
            ]);

            return back()->with('success', 'Setoran warga berhasil dicatat!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mencatat setoran! Info Error DB: ' . $e->getMessage());
        }
    }

    public function destroyKategori($id)
    {
        try {
            KategoriSampah::findOrFail($id)->delete();
            return back()->with('success', 'Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus! Pastikan kategori ini belum dipakai di transaksi.');
        }
    }

    public function destroyTransaksi($id)
    {
        try {
            TransaksiSampah::findOrFail($id)->delete();
            return back()->with('success', 'Data setoran berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus setoran: ' . $e->getMessage());
        }
    }
}