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
            dd("ERROR SAAT LOAD HALAMAN: " . $e->getMessage());
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
            // Flash memory biar tab Kategori kebuka lagi
            return back()->with(['success' => 'Kategori sampah berhasil ditambahkan!', 'active_tab' => 'kategori']);
        } catch (\Exception $e) {
            return back()->with(['error' => 'Gagal menyimpan kategori. Info Error: ' . $e->getMessage(), 'active_tab' => 'kategori']);
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

            // Flash memory biar tab Transaksi kebuka lagi
            return back()->with(['success' => 'Setoran warga berhasil dicatat!', 'active_tab' => 'transaksi']);
        } catch (\Exception $e) {
            return back()->with(['error' => 'Gagal mencatat setoran! Info Error DB: ' . $e->getMessage(), 'active_tab' => 'transaksi']);
        }
    }

    public function updateKategori(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
                'satuan' => 'required|string|max:50',
                'harga_per_satuan' => 'required|numeric|min:0',
            ]);

            $kategori = KategoriSampah::findOrFail($id);
            $kategori->update($request->all());

            return back()->with(['success' => 'Kategori berhasil diperbarui!', 'active_tab' => 'kategori']);
        } catch (\Exception $e) {
            return back()->with(['error' => 'Gagal memperbarui kategori! Info: ' . $e->getMessage(), 'active_tab' => 'kategori']);
        }
    }

    public function updateTransaksi(Request $request, $id)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'kategori_id' => 'required|exists:kategori_sampahs,id',
                'berat_jumlah' => 'required|numeric|min:0.1',
                'tanggal_setor' => 'required|date',
            ]);

            $transaksi = TransaksiSampah::findOrFail($id);
            $kategori = KategoriSampah::findOrFail($request->kategori_id);
            $total_harga = $kategori->harga_per_satuan * $request->berat_jumlah;

            $transaksi->update([
                'user_id' => $request->user_id,
                'kategori_id' => $request->kategori_id,
                'berat_jumlah' => $request->berat_jumlah,
                'total_harga' => $total_harga,
                'tanggal_setor' => $request->tanggal_setor,
            ]);

            return back()->with(['success' => 'Setoran berhasil diperbarui!', 'active_tab' => 'transaksi']);
        } catch (\Exception $e) {
            return back()->with(['error' => 'Gagal memperbarui setoran! Info: ' . $e->getMessage(), 'active_tab' => 'transaksi']);
        }
    }

    public function destroyKategori($id)
    {
        try {
            KategoriSampah::findOrFail($id)->delete();
            return back()->with(['success' => 'Kategori berhasil dihapus!', 'active_tab' => 'kategori']);
        } catch (\Exception $e) {
            return back()->with(['error' => 'Gagal menghapus! Pastikan kategori ini belum dipakai di transaksi.', 'active_tab' => 'kategori']);
        }
    }

    public function destroyTransaksi($id)
    {
        try {
            TransaksiSampah::findOrFail($id)->delete();
            return back()->with(['success' => 'Data setoran berhasil dihapus!', 'active_tab' => 'transaksi']);
        } catch (\Exception $e) {
            return back()->with(['error' => 'Gagal menghapus setoran: ' . $e->getMessage(), 'active_tab' => 'transaksi']);
        }
    }
}