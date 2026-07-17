<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MapLocation;
use Illuminate\Http\Request;

class MapLocationController extends Controller
{
    public function index()
    {
        // Tarik semua data dari database buat ditampilin di tabel
        $locations = MapLocation::all();
        return view('admin.pemetaan.index', compact('locations'));
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim dari Pop-Up Map Admin
        $request->validate([
            'type' => 'required|in:kelurahan,banksampah,rw',
            'title' => 'required|string|max:255',
            'manager_label' => 'required|string|max:50',
            'manager_name' => 'required|string|max:255',
            'contact_label' => 'required|string|max:50',
            'contact_number' => 'nullable|string|max:50',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        MapLocation::create($request->all());
        return redirect()->route('admin.pemetaan.index')->with('success', 'Titik Lokasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $location = MapLocation::findOrFail($id);
        
        $request->validate([
            'type' => 'required|in:kelurahan,banksampah,rw',
            'title' => 'required|string|max:255',
            'manager_label' => 'required|string|max:50',
            'manager_name' => 'required|string|max:255',
            'contact_label' => 'required|string|max:50',
            'contact_number' => 'nullable|string|max:50',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location->update($request->all());
        return redirect()->route('admin.pemetaan.index')->with('success', 'Titik Lokasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        MapLocation::findOrFail($id)->delete();
        return redirect()->route('admin.pemetaan.index')->with('success', 'Titik Lokasi berhasil dihapus!');
    }
}