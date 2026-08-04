<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\LaporanWeb;

class LaporanWebController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kendala' => 'required',
            'deskripsi' => 'required'
        ]);

        LaporanWeb::create([
            'user_id' => auth()->id(),
            'jenis_kendala' => $request->jenis_kendala,
            'deskripsi' => $request->deskripsi
        ]);

        return back()->with('success', 'Laporan kendala berhasil dikirim! Tim Admin akan segera memperbaikinya.');
    }
}