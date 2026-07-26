<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DataWargaController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'semua');

        // Filter murni role 'user' & Urutkan abjad A-Z
        $query = User::where('role', 'user')->orderBy('name', 'asc');

        if ($tab === 'manual') {
            $query->whereNull('google_id');
        } elseif ($tab === 'google') {
            $query->whereNotNull('google_id');
        }

        $warga = $query->get();

        return view('admin.data-warga.index', compact('warga', 'tab'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Proteksi Lapis Ganda: Cuma bisa hapus role user & bukan akun google
        if ($user->role === 'user' && is_null($user->google_id)) {
            $user->delete();
            return redirect()->back()->with('success', 'Data warga berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Akun Google tidak dapat dihapus secara manual.');
    }
}