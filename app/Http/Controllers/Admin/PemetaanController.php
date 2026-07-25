<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class PemetaanController extends Controller
{
    public function index()
    {
        // Ngurutin berdasarkan tipe dulu, baru diurutin berdasarkan abjad/angka title-nya
        $locations = Location::orderByRaw("FIELD(type, 'kelurahan', 'rw', 'banksampah')")
                             ->orderBy('title', 'asc')
                             ->get();
        return view('admin.pemetaan.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required',
            'title' => 'required',
            'manager_label' => 'required',
            'manager_name' => 'required',
            'contact_label' => 'required',
            'koordinat' => 'required',
            'address' => 'required',
            'gmaps_link' => 'nullable',
            'gmaps_button_text' => 'nullable',
            'contact_number' => 'nullable'
        ]);

        if (empty($data['gmaps_button_text'])) {
            $data['gmaps_button_text'] = 'Buka di Google Maps';
        }

        Location::create($data);
        return redirect()->route('admin.pemetaan.index')->with('success', 'Lokasi Peta berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'type' => 'required',
            'title' => 'required',
            'manager_label' => 'required',
            'manager_name' => 'required',
            'contact_label' => 'required',
            'koordinat' => 'required',
            'address' => 'required',
            'gmaps_link' => 'nullable',
            'gmaps_button_text' => 'nullable',
            'contact_number' => 'nullable'
        ]);

        if (empty($data['gmaps_button_text'])) {
            $data['gmaps_button_text'] = 'Buka di Google Maps';
        }

        Location::findOrFail($id)->update($data);
        return redirect()->route('admin.pemetaan.index')->with('success', 'Data Lokasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Location::findOrFail($id)->delete();
        return redirect()->route('admin.pemetaan.index')->with('success', 'Lokasi peta berhasil dihapus!');
    }
}