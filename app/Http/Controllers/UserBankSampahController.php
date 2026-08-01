<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiSampah;
use Illuminate\Support\Facades\Auth;

class UserBankSampahController extends Controller
{
    public function index()
    {
        // Tarik data transaksi HANYA untuk warga yang sedang login
        $transaksi = TransaksiSampah::with('kategoriSampah')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();

        // Otomatis hitung total saldo rupiah dari semua riwayat
        $totalSaldo = $transaksi->sum('total_harga');

        return view('user.bank-sampah.index', compact('transaksi', 'totalSaldo'));
    }
}