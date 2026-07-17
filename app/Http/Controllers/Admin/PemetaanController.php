<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class PemetaanController extends Controller
{
    // Nampilin halaman dan data peta
    public function index()
    {
        $locations = Location::latest()->get();
        return view('admin.pemetaan.index', compact('locations'));
    }

    // Nyimpen data titik peta baru
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'manager_label' => 'required',
            'manager_name' => 'required',
            'contact_label' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
        ]);

        Location::create($request->all());

        return redirect()->route('admin.pemetaan.index')->with('success', 'Titik Peta berhasil ditambahkan!');
    }

    // Mengubah data titik peta
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'manager_label' => 'required',
            'manager_name' => 'required',
            'contact_label' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
        ]);

        $location = Location::findOrFail($id);
        $location->update($request->all());

        return redirect()->route('admin.pemetaan.index')->with('success', 'Data Titik Peta berhasil diperbarui!');
    }

    // Menghapus data titik peta
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('admin.pemetaan.index')->with('success', 'Titik Peta berhasil dihapus!');
    }
}