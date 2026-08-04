<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\LaporanWeb;

class LaporanWebAdminController extends Controller
{
    public function index()
    {
        $laporans = LaporanWeb::with('user')->latest()->get();
        return view('admin.laporan-web.index', compact('laporans'));
    }

    public function resolve($id)
    {
        LaporanWeb::findOrFail($id)->delete();
        return back()->with('success', 'Mantap! Kendala berhasil ditandai sebagai telah diperbaiki.');
    }

    public function destroy($id)
    {
        LaporanWeb::findOrFail($id)->delete();
        return back()->with('success', 'Laporan tidak valid berhasil dihapus.');
    }
}