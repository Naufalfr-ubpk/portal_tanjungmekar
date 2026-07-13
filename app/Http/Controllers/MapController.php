<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class MapController extends Controller
{
    public function index()
    {
        // Ambil semua data lokasi dari database yang udah kita bikin sebelumnya
        $locations = Location::all();
        
        // Arahkan ke halaman view peta
        return view('pemetaan.index', compact('locations'));
    }
}